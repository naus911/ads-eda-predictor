from pathlib import Path

import numpy as np
import pandas as pd
import plotly.express as px
import plotly.graph_objects as go
import streamlit as st

DATA_PATH = "marketing_campaign.csv"

@st.cache_data
def load_data():
    df = pd.read_csv(DATA_PATH)
    if 'Date' in df.columns:
        df['Date'] = pd.to_datetime(df['Date'], errors='coerce')
    # Derived metrics
    if 'Facebook Click-Through Rate (Clicks / View)' not in df.columns and 'Facebook Ad Clicks' in df.columns:
        df['Facebook Click-Through Rate (Clicks / View)'] = df['Facebook Ad Clicks'] / df['Facebook Ad Views']
    if 'AdWords Click-Through Rate (Clicks / View)' not in df.columns and 'AdWords Ad Clicks' in df.columns:
        df['AdWords Click-Through Rate (Clicks / View)'] = df['AdWords Ad Clicks'] / df['AdWords Ad Views']
    return df

df = load_data()

st.header("Overview & KPIs")
col1, col2, col3, col4 = st.columns(4)
col1.metric("Facebook avg views", int(df['Facebook Ad Views'].mean()) if 'Facebook Ad Views' in df.columns else "N/A")
col2.metric("Facebook avg clicks", int(df['Facebook Ad Clicks'].mean()) if 'Facebook Ad Clicks' in df.columns else "N/A")
col3.metric("AdWords avg views", int(df['AdWords Ad Views'].mean()) if 'AdWords Ad Views' in df.columns else "N/A")
col4.metric("AdWords avg clicks", int(df['AdWords Ad Clicks'].mean()) if 'AdWords Ad Clicks' in df.columns else "N/A")

st.subheader("Interactive time series")
ts_cols = ['Facebook Ad Clicks','Facebook Ad Conversions','AdWords Ad Clicks','AdWords Ad Conversions']
available = [c for c in ts_cols if c in df.columns]
sel = st.multiselect("Choose series", options=available, default=available[:2])
if sel:
    fig = go.Figure()
    for c in sel:
        fig.add_trace(go.Scatter(x=df['Date'], y=df[c], mode='lines+markers', name=c))
    fig.update_layout(height=420, xaxis_title="Date", yaxis_title="Count")
    st.plotly_chart(fig, use_container_width=True)

st.subheader("Spend vs Conversions (scatter)")
# Defensive numeric conversion for cost column (handle strings, currency symbols, commas)
cost_col = 'Cost per Facebook Ad'
conv_col = 'Facebook Ad Conversions'
if cost_col in df.columns and conv_col in df.columns:
    # make a copy for plotting
    plot_df = df[[cost_col, conv_col]].copy()
    # Remove common non-numeric characters (currency symbols, commas, spaces)
    plot_df[cost_col] = plot_df[cost_col].astype(str).str.replace(r'[\$,]', '', regex=True).str.strip()
    # Convert to numeric, coerce errors to NaN
    plot_df[cost_col] = pd.to_numeric(plot_df[cost_col], errors='coerce')
    # Drop rows with missing values in either column
    plot_df = plot_df.dropna(subset=[cost_col, conv_col])
    if plot_df.empty:
        st.info("No numeric data available in Cost per Facebook Ad and conversions after cleaning.")
    else:
        try:
            fig = px.scatter(plot_df, x=cost_col, y=conv_col, trendline='ols',
                             title="Facebook: Cost per Ad vs Conversions", labels={'x':'Cost per Ad','y':'Conversions'})
            st.plotly_chart(fig, use_container_width=True)
        except Exception as e:
            st.error(f"Failed to draw Plotly scatter: {e}")
else:
    st.info("Cost/Conversions columns not found for scatter plot.")
    
st.markdown("---")
st.write("You can navigate to **EDA** (detailed charts) and **Statistical Tests** pages for more analyses.")
