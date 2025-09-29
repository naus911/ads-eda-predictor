import numpy as np
import pandas as pd
import plotly.express as px
import statsmodels.api as sm
import streamlit as st
from statsmodels.stats.diagnostic import het_breuschpagan
from statsmodels.tsa.stattools import adfuller, coint

DATA_PATH = "marketing_campaign.csv"

@st.cache_data
def load_data():
    df = pd.read_csv(DATA_PATH)
    if 'Date' in df.columns:
        df['Date'] = pd.to_datetime(df['Date'], errors='coerce')
    return df

def clean_currency_series(series):
    """Take a Series that may contain currency-like strings and return numeric Series (float) with NaNs for non-convertible."""
    s = series.astype(str).str.replace(r'[\$,]', '', regex=True).str.strip()
    return pd.to_numeric(s, errors='coerce')

def prepare_pair_for_coint(df, col_x, col_y):
    """Return two aligned numeric series (drop NaNs)."""
    if col_x not in df.columns or col_y not in df.columns:
        return None, None, "missing"
    sx = df[col_x].copy()
    sy = df[col_y].copy()

    # If either looks like currency/text, try cleaning
    if sx.dtype == object or sx.dtype == "string":
        sx = clean_currency_series(sx)
    else:
        sx = pd.to_numeric(sx, errors='coerce')

    if sy.dtype == object or sy.dtype == "string":
        sy = clean_currency_series(sy)
    else:
        sy = pd.to_numeric(sy, errors='coerce')

    # Align by index and drop NaNs
    common_idx = sx.index.intersection(sy.index)
    sx = sx.loc[common_idx]
    sy = sy.loc[common_idx]
    both = pd.concat([sx, sy], axis=1).dropna()
    if both.empty:
        return None, None, "nodata"
    return both.iloc[:,0], both.iloc[:,1], "ok"

df = load_data()
st.header("Statistical Tests & Regression Diagnostics")

st.subheader("Cointegration tests (from notebook)")
pairs = [
    ('Cost per Facebook Ad', 'Facebook Ad Conversions'),
    ('AdWords Cost per Click (Ad Cost / Clicks)', 'AdWords Ad Conversions'),
]

for x, y in pairs:
    st.write(f"**{x}** vs **{y}**")
    sx, sy, status = prepare_pair_for_coint(df, x, y)
    if status == "missing":
        st.info(f"Columns {x} or {y} not found in dataset.")
        continue
    if status == "nodata":
        st.info(f"No overlapping numeric data after cleaning for {x} and {y}.")
        continue

    try:
        score, pvalue, _ = coint(sx, sy)
        st.write(f"cointegration test score = {score:.4f}, p-value = {pvalue:.6f}")
        if pvalue < 0.05:
            st.success("Cointegrated (reject null).")
        else:
            st.info("Not cointegrated (fail to reject null).")
    except Exception as e:
        st.error("Cointegration test failed: " + str(e))

st.markdown("---")
st.subheader("Regression diagnostics: OLS between clicks and conversions (Facebook)")

# Ensure numeric conversion for regression variables
if 'Facebook Ad Clicks' in df.columns and 'Facebook Ad Conversions' in df.columns:
    X = df[['Facebook Ad Clicks']].copy()
    y = df['Facebook Ad Conversions'].copy()

    # Convert to numeric defensively
    X['Facebook Ad Clicks'] = pd.to_numeric(X['Facebook Ad Clicks'], errors='coerce')
    y = pd.to_numeric(y, errors='coerce')

    # Drop NaNs
    reg_df = pd.concat([X, y], axis=1).dropna()
    if reg_df.empty:
        st.info("No numeric data available for regression after cleaning.")
    else:
        X_clean = sm.add_constant(reg_df[['Facebook Ad Clicks']])
        y_clean = reg_df['Facebook Ad Conversions']
        try:
            model = sm.OLS(y_clean, X_clean).fit()
            st.write(model.summary())
            # residuals plot
            res = model.resid
            fig = px.scatter(x=model.fittedvalues, y=res, labels={'x':'Fitted','y':'Residuals'}, title="Residuals vs Fitted")
            st.plotly_chart(fig, use_container_width=True)

            # Breusch-Pagan test for heteroscedasticity
            bp_test = het_breuschpagan(res, X_clean)
            bp_labels = ['Lagrange multiplier statistic', 'p-value', 'f-value', 'f p-value']
            bp_out = dict(zip(bp_labels, bp_test))
            st.write("Breusch-Pagan test results:", bp_out)
        except Exception as e:
            st.error("Regression diagnostics failed: " + str(e))
else:
    st.info("Required columns for regression not found.")

st.markdown("---")
st.subheader("Additional: Augmented Dickey-Fuller on Facebook Clicks")

if 'Facebook Ad Clicks' in df.columns:
    series = df['Facebook Ad Clicks'].copy()
    series = pd.to_numeric(series, errors='coerce').dropna().astype(float)
    if series.empty:
        st.info("No numeric Facebook Ad Clicks data available for ADF test.")
    else:
        try:
            adf_stat, pval, usedlag, nobs, crit, icbest = adfuller(series)
            st.write(f"ADF statistic = {adf_stat:.4f}, p-value = {pval:.6f}")
            st.write("Critical values:", crit)
            if pval < 0.05:
                st.success("Series appears stationary (reject unit root).")
            else:
                st.info("Series appears non-stationary (fail to reject unit root).")
        except Exception as e:
            st.error("ADF failed: " + str(e))
else:
    st.info("Facebook Ad Clicks column not found.")
