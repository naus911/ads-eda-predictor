import matplotlib.pyplot as plt
import numpy as np
import pandas as pd
import seaborn as sns
import streamlit as st

DATA_PATH = "marketing_campaign.csv"

@st.cache_data
def load_data():
    df = pd.read_csv(DATA_PATH)
    if 'Date' in df.columns:
        df['Date'] = pd.to_datetime(df['Date'], errors='coerce')
    return df

def clean_currency_column(series):
    """Strip common currency characters and convert to float (NaN on failure)."""
    s = series.astype(str).str.replace(r'[\$,]', '', regex=True).str.strip()
    return pd.to_numeric(s, errors='coerce')

df = load_data()
st.header("Notebook Reproductions — exact plots (matplotlib/seaborn)")
st.write("This page attempts to recreate the notebook's matplotlib & seaborn plots as closely as possible.")

st.subheader("Seaborn histograms of clicks and conversions")
cols = ['Facebook Ad Clicks','Facebook Ad Conversions','AdWords Ad Clicks','AdWords Ad Conversions']
for c in cols:
    if c in df.columns:
        st.write(f"### {c}")
        fig,ax = plt.subplots(figsize=(8,3))
        sns.histplot(df[c].dropna(), kde=True, ax=ax)
        st.pyplot(fig)

st.subheader("Scatter with regression line (Facebook cost vs conversions if present)")

cost_col = 'Cost per Facebook Ad'
conv_col = 'Facebook Ad Conversions'

if cost_col in df.columns and conv_col in df.columns:
    # Prepare a copy and clean the cost column defensively
    plot_df = df[[cost_col, conv_col]].copy()
    plot_df[cost_col] = clean_currency_column(plot_df[cost_col])
    plot_df[conv_col] = pd.to_numeric(plot_df[conv_col], errors='coerce')
    plot_df = plot_df.dropna(subset=[cost_col, conv_col])

    if plot_df.empty:
        st.info("No numeric data available for Cost per Facebook Ad and Facebook Ad Conversions after cleaning.")
    else:
        try:
            fig, ax = plt.subplots(figsize=(6,4))
            # Use lowess smoothing like the original notebook (if seaborn supports it)
            sns.regplot(x=cost_col, y=conv_col, data=plot_df, lowess=True, ax=ax,
                        scatter_kws={'s':20, 'alpha':0.6}, line_kws={'color':'red'})
            ax.set_title("Cost per Facebook Ad vs Facebook Ad Conversions (regression + LOWESS)")
            ax.set_xlabel("Cost per Facebook Ad (numeric)")
            ax.set_ylabel("Facebook Ad Conversions")
            st.pyplot(fig)
        except Exception as e:
            # Catch and show helpful error (this prevents the UFuncTypeError from bubbling)
            st.error(f"Failed to draw seaborn regplot: {e}")
else:
    st.info("Required columns not found for scatter/regression (Cost per Facebook Ad / Facebook Ad Conversions).")
