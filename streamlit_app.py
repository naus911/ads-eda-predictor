import streamlit as st

st.set_page_config(page_title="Marketing AB Testing — Multi-page", layout="wide")
st.title("🤖 Marketing Data Science Studio — EDA, Econometrics & Predictive Pipelines")

st.markdown("""
This multi-page app extends your Jupyter notebook analyses into an interactive dashboard.  
It integrates **fundamentals of data exploration**, **statistical inference**, **econometrics tests**, and **machine learning diagnostics**, all applied to real marketing campaign data.  

The project compares **Facebook Ads** vs **AdWords Ads** campaigns, focusing on clicks, conversions, costs, and rates.  

Below is a detailed guide to each page of this app, including **mathematical intuition and data-science concepts**.
---  
""")
st.markdown("### Quick links")
st.markdown(
    "- [Dashboard](/?page=pages/1_Dashboard.py)  •  [EDA](/?page=pages/2_EDA.py)  •  "
    "[Statistical Tests](/?page=pages/3_Statistical_Tests.py)  •  "
    "[Notebook Reproductions](/?page=pages/4_Notebook_Reproductions.py)  •  "
    "[Predictor](/?page=pages/5_Predictor.py)"
)

st.header("📌 Pages Overview with Mathematical & Data Science Intuition")

st.subheader("1️⃣ Dashboard — Overview, KPIs & Time-series  " + 
             "[open ▶](/?page=pages/1_Dashboard.py)  [alt ▶](/?page=1_Dashboard)")
st.markdown(r"""
**Purpose:** Provide an executive-level overview with **Key Performance Indicators (KPIs)**, time-series trends, and scatter plots.

**KPIs (Averages & dispersion)**
- **Mean (sample):**  
  $$\bar{X} = \frac{1}{n}\sum_{i=1}^n X_i$$
- **Sample variance / standard deviation:**  
  $$s^2 = \frac{1}{n-1}\sum_{i=1}^n (X_i - \bar{X})^2,\qquad s=\sqrt{s^2}$$
- **Standard error of the mean (SEM):**  
  $$\text{SEM} = \frac{s}{\sqrt{n}}$$
  Use SEM when reporting uncertainty in KPI estimates.

**Time-series trends**
- Visualizing $$X_t$$ over time helps detect:
  - **Trend:** long-term increase/decrease (modeled as deterministic trend $$\beta t$$ or stochastic drift),
  - **Seasonality:** periodic components (weekly/monthly),
  - **Structural breaks:** sudden level/variance changes.
- Detrending: remove a fitted linear trend or use first differences
  $$\Delta X_t = X_t - X_{t-1}$$
  to stabilize the mean.

**Scatter & linear regression**
- Visualize relationship between **Cost per Ad (X)** and **Conversions (Y)**.
- **Ordinary Least Squares (OLS)** estimates coefficients minimizing squared residuals:
  $$\hat\beta = \arg\min_\beta \sum_{i=1}^n (Y_i - \beta_0 - \beta_1 X_i)^2.$$
  Closed form (single predictor):
  $$
    \hat\beta_1 = \frac{\sum (X_i - \bar X)(Y_i - \bar Y)}{\sum (X_i - \bar X)^2}, \qquad
    \hat\beta_0 = \bar Y - \hat\beta_1 \bar X.
  $$

- **Interpretation:** $$\hat\beta_1$$ is the *marginal* conversions per unit increase in cost (if model assumptions hold).
- **Assumptions**: linearity, independent errors, homoscedasticity (constant variance), no omitted confounders.
- If assumptions fail, consider transformations (log, square-root), robust regression, or non-linear models.
""")

st.subheader("2️⃣ Exploratory Data Analysis (EDA) — Distributions & Correlations  " +
             "[open ▶](/?page=pages/2_EDA.py)  [alt ▶](/?page=2_EDA)")
st.markdown(r"""
**Purpose:** Understand distributions, outliers, relationships, and appropriate transformations.

**Distributions & moments**
- **Skewness** measures asymmetry:
  $$\text{Skewness} = \frac{1}{n}\sum\left(\frac{X_i-\bar X}{s}\right)^3$$
- **Kurtosis** measures tail/heaviness:
  $$\text{Kurtosis} = \frac{1}{n}\sum\left(\frac{X_i-\bar X}{s}\right)^4$$
- Use **log-transform** when data are multiplicative or heavy-tailed:
  $$X' = \log(X + c),\quad c\ge 0\ \text{(small constant to handle zeros)}.$$

**Histogram & KDE**
- Histogram: empirical frequency counts; KDE approximates the probability density function
  $$\hat f(x) = \frac{1}{nh}\sum_{i=1}^n K\!\left(\frac{x-X_i}{h}\right)$$
  where $$K$$ is a kernel (e.g. Gaussian) and $$h$$ the bandwidth.

**Quantile segmentation**
- Given quantiles $$Q_{p}$$ (e.g. $$Q_{0.25}, Q_{0.75}$$), you can segment days into performance bands:
  - low: $$X \le Q_{0.25}$$
  - medium: $$Q_{0.25} < X \le Q_{0.75}$$
  - high: $$X > Q_{0.75}$$

**Correlation & association**
- **Pearson correlation** (linear association):
  $$r_{XY} = \frac{\text{Cov}(X,Y)}{\sigma_X\sigma_Y} = \frac{\sum (X_i-\bar X)(Y_i-\bar Y)}{\sqrt{\sum (X_i-\bar X)^2}\sqrt{\sum (Y_i-\bar Y)^2}}.$$
- **Rank correlation (Spearman)** useful when relationship is monotonic but non-linear.
- **Caveat:** correlation ≠ causation. Always consider confounders and time-ordering in campaigns.
""")

st.subheader("3️⃣ Statistical Tests & Regression Diagnostics — Econometrics & Time-series  " +
             "[open ▶](/?page=pages/3_Statistical_Tests.py)  [alt ▶](/?page=3_Statistical_Tests)")
st.markdown(r"""
**Purpose:** Validate hypotheses and check model assumptions with formal tests.

**Stationarity & ADF (Augmented Dickey-Fuller)**
- ADF tests for a unit root (non-stationarity). Example regression:
  $$\Delta Y_t = \alpha + \beta t + \gamma Y_{t-1} + \sum_{i=1}^p \delta_i \Delta Y_{t-i} + \varepsilon_t.$$
- Null $$H_0:\gamma=0$$ (unit root — non-stationary); reject null if ADF statistic sufficiently negative (p-value < chosen $$\alpha$$).

**Cointegration (Engle–Granger two-step)**
- If $$X_t$$ and $$Y_t$$ are individually non-stationary (I(1)) but a linear combination is stationary, they are cointegrated:
  1. Regress $$Y_t = \alpha + \beta X_t + u_t$$.
  2. Test residuals $$u_t$$ for stationarity using ADF. If residuals are stationary $$\Rightarrow$$ cointegration.
- Intuition: cointegration indicates a long-run equilibrium relationship; short-run deviations are mean-reverting.

**Regression diagnostics**
- After fitting OLS, inspect:
  - **Residual vs fitted** — non-linearity or heteroscedasticity shows up here.
  - **Breusch–Pagan test** for heteroscedasticity: regress squared residuals on predictors; significant test indicates heteroscedasticity.
  - **Normality** of residuals (e.g. Shapiro–Wilk); minor violations ok for large samples due to CLT.
- **Heteroscedasticity-consistent (robust) standard errors** (e.g. HC3) can be used when variance is not constant.

**Model selection & inference**
- Use adjusted $$R^2$$, AIC/BIC, cross-validated RMSE for model comparison.
- Be wary of overfitting; cross-validation and penalized regressions (Ridge/Lasso) help control variance.
""")

st.subheader("4️⃣ Notebook Reproductions — Matplotlib/Seaborn validation  " +
             "[open ▶](/?page=pages/4_Notebook_Reproductions.py)  [alt ▶](/?page=4_Notebook_Reproductions)")
st.markdown(r"""
**Purpose:** Recreate the original notebook visuals (matplotlib/seaborn) for exact validation and presentation.

**LOWESS (locally weighted scatterplot smoothing)**
- LOWESS fits local regressions around each target $$x_0$$ with weights $$w_i = K\left(\frac{|x_i-x_0|}{h}\right)$$.
- Solves a weighted least squares at each $$x_0$$. Useful for capturing smooth nonlinear relationships without a global parametric form.

**Reproducibility**
- Using the same plotting libraries/parameters ensures stakeholders see the identical diagnostics used during the offline analysis.
""")

st.subheader("5️⃣ Predictor — Pipelines, Encoding, CV & Prediction  " +
             "[open ▶](/?page=pages/5_Predictor.py)  [alt ▶](/?page=5_Predictor)")
st.markdown(r"""
**Purpose:** Allow users to train several regression models on the dataset and **predict** a numeric target by entering custom inputs — now with production-minded preprocessing and encoding.

- Median imputation (robust to outliers):  
  $$\text{median}(X)$$
- Optional scaling:
  - **StandardScaler:**  
    $$X' = \frac{X-\mu}{\sigma}$$
  - **MinMaxScaler:**  
    $$X' = \frac{X - X_{\min}}{X_{\max} - X_{\min}}$$


**Models & regularization**
- **Linear Regression (OLS)** — baseline with closed-form (or numerical) solution.
- **Ridge (L2)**:
  $$\min_\beta \sum_{i}(y_i - X_i\beta)^2 + \alpha \|\beta\|_2^2$$
  shrinks coefficients toward zero; reduces variance at cost of bias.
- **Lasso (L1)**:
  $$\min_\beta \sum_{i}(y_i - X_i\beta)^2 + \alpha \|\beta\|_1$$
  encourages sparsity (feature selection).
- **Random Forest** — ensemble of $$B$$ trees, prediction averaged:
  $$\hat f(x) = \frac{1}{B}\sum_{b=1}^B T_b(x).$$

**Model evaluation & tuning**
- **Cross-validation (k-fold)**: split data into k folds, rotate test fold → robust estimate of generalization error.
- **GridSearchCV**: search over hyperparameter grid using k-fold CV; scoring uses RMSE (we report RMSE and $$R^2$$ on held-out test set).
- **Bias–Variance tradeoff:** regularization and ensemble methods trade bias/variance differently; inspect CV curves to tune.

**Persistence & deployment**
- Save the full pipeline (preprocessing + estimator) with `joblib.dump()` for serving. Ensure custom transformers are importable from stable modules (so pickling/unpickling is reliable).
- For production: standardize training pipeline, persist feature metadata (category lists, scalers), and serve via an API.

**Correlation & diagnostics (pre-training)**
- Numeric: Pearson correlation matrix and heatmap.
- Categorical: one-hot dummies correlation with numeric target to identify strong category-target associations.

**Best practices**
- Use pipelines (ColumnTransformer) to avoid training/serving mismatch.
- For high-cardinality categories consider target encoding or hashing as alternatives to plain OHE.
- Always validate on a hold-out set and use cross-validation for tuning.
""")

st.markdown("---")
st.info("""
**In summary:**  
- The **Dashboard** gives business users a high-level view.  
- The **EDA** dives into data science fundamentals (distributions, correlations) and recommends transformations when needed.  
- The **Statistical Tests** page provides rigorous econometric checks (cointegration, stationarity, regression diagnostics).  
- The **Notebook Reproductions** validate reproducibility and present the same visual evidence used in analysis.  
- The **Predictor** page contains a production-minded pipeline: per-column categorical controls, ColumnTransformer preprocessing (imputation + scaling + OHE), GridSearchCV tuning, model persistence, and correlation diagnostics.

Together, the app bridges **business insight** ↔ **data science fundamentals** ↔ **advanced statistics**.  

""")
