# pages/5_Predictor.py
import os
import sys
import time
from pathlib import Path

import joblib
# plotting
import matplotlib.pyplot as plt
import numpy as np
import pandas as pd
import seaborn as sns
# ML imports
from sklearn.base import BaseEstimator, TransformerMixin
from sklearn.compose import ColumnTransformer
from sklearn.ensemble import RandomForestRegressor
from sklearn.impute import SimpleImputer
from sklearn.linear_model import Lasso, LinearRegression, Ridge
from sklearn.metrics import mean_squared_error, r2_score
from sklearn.model_selection import GridSearchCV, KFold, train_test_split
from sklearn.pipeline import Pipeline
from sklearn.preprocessing import MinMaxScaler, OneHotEncoder, StandardScaler

import streamlit as st

# -------------------------
# Paths (relative to project root)
# -------------------------
# Project root = parent of the pages/ folder
PROJECT_ROOT = Path(__file__).resolve().parent.parent
DATA_PATH = PROJECT_ROOT / "marketing_campaign.csv"
MODEL_DIR = PROJECT_ROOT / "saved_models"
os.makedirs(MODEL_DIR, exist_ok=True)

# Make sure project root is importable (so rare_grouper module can be imported)
if str(PROJECT_ROOT) not in sys.path:
    sys.path.insert(0, str(PROJECT_ROOT))

# Import RareCategoryGrouper from stable module (ensure rare_grouper.py exists at project root)
try:
    from rare_grouper import RareCategoryGrouper
except Exception as e:
    # If import fails, define a minimal fallback that does no grouping (but warn user)
    st.warning(
        "Could not import rare_grouper.RareCategoryGrouper — falling back to no-op grouper. "
        "Create rare_grouper.py in project root for robust saving/loading. Error: " + str(e)
    )

    class RareCategoryGrouper(BaseEstimator, TransformerMixin):
        def __init__(self, groups=None):
            self.groups = groups or {}

        def fit(self, X, y=None):
            return self

        def transform(self, X):
            return X


# -------------------------
# Load & simple cleaning
# -------------------------
@st.cache_data
def load_and_clean(path):
    df = pd.read_csv(path)
    if 'Date' in df.columns:
        df['Date'] = pd.to_datetime(df['Date'], errors='coerce')

    def clean_currency(s):
        return pd.to_numeric(
            s.astype(str).str.replace(r'[\$,]', '', regex=True).str.strip(),
            errors='coerce'
        )

    for col in df.columns:
        if 'Cost' in col or 'cost' in col or 'Price' in col or 'price' in col:
            try:
                df[col] = clean_currency(df[col])
            except Exception:
                pass
    return df


df = load_and_clean(str(DATA_PATH))

# -------------------------
# Page header
# -------------------------
st.header("🔮 Predictor — pipelines, CV, encoding, persistence & correlation analysis")
st.markdown(
    """
Train pipelines with per-column preprocessing (numeric/categorical), tune with GridSearchCV, persist pipelines,
and inspect correlations between selected predictors and the target (numeric heatmap + categorical correlations).
"""
)

# -------------------------
# Target & predictors UI
# -------------------------
numeric_cols_all = df.select_dtypes(include=[np.number]).columns.tolist()
all_cols = df.columns.tolist()
if not numeric_cols_all:
    st.error("No numeric columns found in dataset; need at least one numeric column as target.")
    st.stop()

st.subheader("1) Choose target & predictors")
target = st.selectbox("Target variable (numeric)", options=numeric_cols_all)
possible_predictors = [c for c in all_cols if c != target]
predictors = st.multiselect(
    "Predictors (numeric or categorical)", options=possible_predictors, default=possible_predictors[:4]
)

if not predictors:
    st.info("Select at least one predictor to continue.")
    st.stop()

selected_numeric = [c for c in predictors if c in numeric_cols_all]
selected_categorical = [c for c in predictors if c not in numeric_cols_all]
st.markdown(
    f"**Numeric:** {selected_numeric if selected_numeric else 'None'} — **Categorical:** {selected_categorical if selected_categorical else 'None'}"
)

# -------------------------
# Categorical per-column controls
# -------------------------
cat_settings = {}
if selected_categorical:
    st.subheader("Categorical controls (per column)")
    for col in selected_categorical:
        with st.expander(f"'{col}' settings", expanded=False):
            st.write("Group rare categories by relative frequency threshold or keep top-k categories (rest -> __OTHER__).")
            min_freq = st.slider(
                f"{col}: minimum relative frequency (0 = disabled)", 0.0, 0.5, 0.0, step=0.01, key=f"{col}_minfreq"
            )
            top_k = st.number_input(
                f"{col}: keep top-k categories (0 = keep all)", min_value=0, max_value=1000, value=0, step=1, key=f"{col}_topk"
            )
            min_freq_val = None if float(min_freq) == 0.0 else float(min_freq)
            top_k_val = None if int(top_k) == 0 else int(top_k)
            cat_settings[col] = {'min_freq': min_freq_val, 'top_k': top_k_val}
else:
    cat_settings = {}

# -------------------------
# Modeling options
# -------------------------
st.subheader("2) Modeling & preprocessing options")
model_name = st.selectbox(
    "Estimator", ["Linear Regression", "Ridge Regression", "Lasso Regression", "Random Forest"]
)
scaler_choice = st.selectbox("Scaler (numeric)", ["StandardScaler", "MinMaxScaler", "None"])
cv_folds = st.slider("CV folds (k)", 2, 10, 5)
random_state = int(st.number_input("Random seed", value=42, step=1))

# Hyperparam grids
st.markdown("**GridSearch params (comma-separated)**")
grid_params = {}
if model_name in ["Ridge Regression", "Lasso Regression"]:
    alpha_vals = st.text_input("Alpha values (comma separated)", value="0.01,0.1,1.0,10.0")
    try:
        grid_params['alpha'] = [float(x.strip()) for x in alpha_vals.split(",") if x.strip() != ""]
    except:
        grid_params['alpha'] = [1.0]
elif model_name == "Random Forest":
    n_estimators = st.text_input("n_estimators (comma separated)", value="50,100,200")
    max_depths = st.text_input("max_depth (comma separated, 0=none)", value="0,5,10")
    try:
        ne = [int(x.strip()) for x in n_estimators.split(",") if x.strip() != ""]
        md = [None if int(x.strip()) == 0 else int(x.strip()) for x in max_depths.split(",") if x.strip() != ""]
        grid_params['n_estimators'] = ne
        grid_params['max_depth'] = md
    except:
        grid_params['n_estimators'] = [100]
        grid_params['max_depth'] = [None]
else:
    grid_params = {}

# -------------------------
# Correlation analysis (NEW)
# -------------------------
st.subheader("Correlation analysis — selected predictors vs target")

# Show numeric correlation heatmap (numeric predictors + target)
try:
    numeric_for_corr = [c for c in selected_numeric]
    if target not in numeric_for_corr:
        numeric_for_corr = numeric_for_corr + [target] if target in numeric_cols_all else numeric_for_corr

    if numeric_for_corr and len(numeric_for_corr) >= 2:
        corr_df = df[numeric_for_corr].dropna()
        if not corr_df.empty:
            corr_mat = corr_df.corr()
            st.write("Pearson correlation matrix (numeric features & target):")
            st.dataframe(corr_mat.round(4))

            # heatmap
            fig, ax = plt.subplots(figsize=(6, max(3, 0.5 * len(numeric_for_corr))))
            sns.heatmap(corr_mat, annot=True, fmt=".2f", cmap="coolwarm", ax=ax, vmin=-1, vmax=1)
            ax.set_title("Correlation heatmap (numeric)")
            st.pyplot(fig)
        else:
            st.info("Not enough numeric rows to compute correlations (after dropping NaNs).")
    else:
        st.info("Not enough numeric features selected to compute numeric correlation heatmap (need >=2).")
except Exception as e:
    st.error("Numeric correlation analysis failed: " + str(e))

# Categorical -> Target correlations (if categorical predictors exist and target is numeric)
if selected_categorical and target in numeric_cols_all:
    try:
        dummies = pd.get_dummies(df[selected_categorical].astype(str), dummy_na=False)
        # align index with target series and drop NA target
        target_series = df[target]
        mask = target_series.notna()
        if mask.sum() == 0:
            st.info("Target has no non-null values for categorical correlation analysis.")
        else:
            corr_with_target = dummies.loc[mask].corrwith(target_series.loc[mask])
            # take top absolute correlations
            topk = corr_with_target.abs().sort_values(ascending=False).head(20)
            st.write("Top correlations between categorical dummies and the numeric target (one-hot encoded categories):")
            out_df = pd.DataFrame({
                "category_dummy": topk.index,
                "corr_with_target": corr_with_target.loc[topk.index].values,
                "abs_corr": corr_with_target.loc[topk.index].abs().values
            }).reset_index(drop=True)
            st.dataframe(out_df)
    except Exception as e:
        st.error("Categorical -> target correlation analysis failed: " + str(e))
else:
    if not selected_categorical:
        st.info("No categorical predictors selected for categorical->target correlation.")
    elif target not in numeric_cols_all:
        st.info("Target is not numeric; categorical->numeric correlation is skipped.")

st.markdown("---")

# -------------------------
# Train / Tune (existing flow)
# -------------------------
st.subheader("3) Train / Tune model")
test_size = st.slider("Test set proportion", 0.05, 0.5, 0.2)

# Keep rows with NaNs; pipeline handles imputation
data = df[[target] + predictors].copy()
if data.empty:
    st.error("No data for selected columns.")
    st.stop()

X = data[predictors]
y = data[target]
# ensure random_state variable exists (defensive)
if 'random_state' not in locals():
    random_state = 42
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=test_size, random_state=random_state)

# numeric pipeline
num_steps = [("imputer", SimpleImputer(strategy="median"))]
if scaler_choice == "StandardScaler":
    num_steps.append(("scaler", StandardScaler()))
elif scaler_choice == "MinMaxScaler":
    num_steps.append(("scaler", MinMaxScaler()))
num_pipeline = Pipeline(num_steps)

# categorical pipeline with RareCategoryGrouper
cat_pipeline = None
# Build OneHotEncoder in a version-compatible way (sparse vs sparse_output)
# Some sklearn versions accept `sparse=False`, others use `sparse_output=False`.
try:
    ohe = OneHotEncoder(handle_unknown="ignore", sparse=False)
except TypeError:
    try:
        ohe = OneHotEncoder(handle_unknown="ignore", sparse_output=False)
    except TypeError:
        # fallback to default; may produce sparse output
        ohe = OneHotEncoder(handle_unknown="ignore")

if selected_categorical:
    cat_pipeline = Pipeline(
        [
            ("grouper", RareCategoryGrouper(groups=cat_settings)),
            ("imputer", SimpleImputer(strategy="most_frequent")),
            ("ohe", ohe),
        ]
    )

transformers = []
if selected_numeric:
    transformers.append(("num", num_pipeline, selected_numeric))
if selected_categorical:
    transformers.append(("cat", cat_pipeline, selected_categorical))

preprocessor = ColumnTransformer(transformers=transformers, remainder="drop", sparse_threshold=0)

# estimator selection
estimator = None
param_grid = {}
if model_name == "Linear Regression":
    estimator = LinearRegression()
elif model_name == "Ridge Regression":
    estimator = Ridge()
    if 'alpha' in grid_params:
        param_grid = {'est__alpha': grid_params['alpha']}
elif model_name == "Lasso Regression":
    estimator = Lasso(max_iter=20000)
    if 'alpha' in grid_params:
        param_grid = {'est__alpha': grid_params['alpha']}
elif model_name == "Random Forest":
    estimator = RandomForestRegressor(random_state=random_state)
    if 'n_estimators' in grid_params:
        param_grid['est__n_estimators'] = grid_params['n_estimators']
    if 'max_depth' in grid_params:
        param_grid['est__max_depth'] = grid_params['max_depth']

pipeline = Pipeline([("pre", preprocessor), ("est", estimator)])
do_grid = st.checkbox("Perform GridSearchCV (use param grid above)", value=bool(param_grid))

trained_pipeline = None
if st.button("Run training"):
    with st.spinner("Training..."):
        try:
            if do_grid and param_grid:
                cv = KFold(n_splits=cv_folds, shuffle=True, random_state=random_state)
                grid = GridSearchCV(pipeline, param_grid, cv=cv, scoring="neg_root_mean_squared_error", n_jobs=-1)
                grid.fit(X_train, y_train)
                trained_pipeline = grid.best_estimator_
                st.success("GridSearchCV complete")
                st.write("Best params:", grid.best_params_)
                st.write(f"Best CV score (neg RMSE): {grid.best_score_:.4f}")
            else:
                pipeline.fit(X_train, y_train)
                trained_pipeline = pipeline
                st.success("Pipeline trained (no grid search)")

            # store model in session_state
            st.session_state["best_model"] = trained_pipeline
            st.session_state["best_model_info"] = {
                "model_name": model_name,
                "predictors": predictors,
                "target": target,
                "trained_at": int(time.time()),
            }

            # Evaluate
            y_pred = trained_pipeline.predict(X_test)
            try:
                rmse = mean_squared_error(y_test, y_pred, squared=False)  # new sklearn
            except TypeError:
                rmse = np.sqrt(mean_squared_error(y_test, y_pred))
            r2 = r2_score(y_test, y_pred)
            st.write(f"Test RMSE: **{rmse:.4f}**, R²: **{r2:.4f}**")
        except Exception as e:
            st.error(f"Training failed: {e}")

# Save / Download trained model
st.markdown("---")
st.subheader("Save / Download trained model")
if "best_model" in st.session_state:
    st.write("A trained pipeline is available in this session.")
    if st.button("Save trained pipeline to disk"):
        try:
            model_obj = st.session_state["best_model"]
            ts = int(time.time())
            fname = f"model_{st.session_state['best_model_info']['model_name'].replace(' ','_')}_{ts}.joblib"
            fpath = os.path.join(MODEL_DIR, fname)
            joblib.dump(model_obj, fpath)
            st.session_state["last_saved_model"] = fpath
            st.success(f"Saved model to {fpath}")
            with open(fpath, "rb") as f:
                st.download_button("Download .joblib", data=f.read(), file_name=fname, mime="application/octet-stream")
        except Exception as e:
            st.error(f"Saving failed: {e}")
else:
    st.info("No trained model in session to save. Train a model first.")

# Load existing model
st.markdown("---")
st.subheader("Load an existing saved model")
saved_models = sorted([f for f in os.listdir(MODEL_DIR) if f.endswith(".joblib")])
choice = st.selectbox("Choose saved model", options=["(none)"] + saved_models)
if choice and choice != "(none)":
    model_path = os.path.join(MODEL_DIR, choice)
    if st.button("Load selected model"):
        try:
            loaded = joblib.load(model_path)
            st.session_state["loaded_model"] = loaded
            st.success(f"Loaded {choice} into session (key: loaded_model)")
        except Exception as e:
            st.error(f"Failed to load model: {e}")

# Manual prediction
st.markdown("---")
st.subheader("Manual prediction (use trained or loaded pipeline)")

# Build the input form for manual prediction
st.write("Pipeline ready for prediction. Provide values for the features you trained with.")
input_dict = {}
cols_ui = st.columns(max(1, min(len(predictors), 4)))
for i, feature in enumerate(predictors):
    if feature in selected_numeric:
        default_val = str(float(data[feature].median(skipna=True)))
        val = cols_ui[i % len(cols_ui)].text_input(f"{feature} (numeric)", value=default_val)
        try:
            input_dict[feature] = float(val)
        except:
            input_dict[feature] = np.nan
    else:
        default_val = str(data[feature].mode().iloc[0]) if not data[feature].mode().empty else ""
        val = cols_ui[i % len(cols_ui)].text_input(f"{feature} (categorical)", value=default_val)
        input_dict[feature] = val

# Two-button layout: predict with trained model (session) OR with loaded model (from disk)
col_a, col_b = st.columns(2)

with col_a:
    if st.button("Predict with trained model (this session)"):
        model_trained = st.session_state.get("best_model")
        if model_trained is None:
            st.error("No trained model available in this session. Train a model first.")
        else:
            try:
                input_df = pd.DataFrame([input_dict])
                if selected_numeric and input_df[selected_numeric].isnull().any().any():
                    st.error("Please provide numeric values for numeric features.")
                else:
                    pred = model_trained.predict(input_df)[0]
                    st.success(f"Predicted {target} (trained model): **{pred:.4f}**")
            except Exception as e:
                st.error(f"Prediction with trained model failed: {e}")

with col_b:
    if st.button("Predict with loaded model (from disk)"):
        model_loaded = st.session_state.get("loaded_model")
        if model_loaded is None:
            st.error("No model loaded from disk. Load a saved model first.")
        else:
            try:
                input_df = pd.DataFrame([input_dict])
                if selected_numeric and input_df[selected_numeric].isnull().any().any():
                    st.error("Please provide numeric values for numeric features.")
                else:
                    pred = model_loaded.predict(input_df)[0]
                    st.success(f"Predicted {target} (loaded model): **{pred:.4f}**")
            except Exception as e:
                st.error(f"Prediction with loaded model failed: {e}")

st.markdown("---")
st.caption(
    """
Notes:
- Correlation heatmap is Pearson's correlation on numeric features and the numeric target.
- For categorical predictors we compute one-hot dummies and show correlations between those dummies and the numeric target (useful for detecting strong category-target associations).
"""
)
