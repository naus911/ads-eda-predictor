import altair as alt
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
    return df

df = load_data()
st.header("Exploratory Data Analysis (Charts from the notebook)")

st.subheader("Distributions (Plotly + KDE)")
numeric_cols = df.select_dtypes(include=[np.number]).columns.tolist()
col = st.selectbox("Choose numeric column", numeric_cols, index=0)
fig = px.histogram(df, x=col, nbins=40, marginal="rug", title=f"Histogram of {col}")
st.plotly_chart(fig, use_container_width=True)

st.subheader("Conversion categories (zero/low/medium/high)")
# replicate notebook category logic
if 'Facebook Ad Conversions' in df.columns:
    q = df['Facebook Ad Conversions'].quantile([0.25,0.75])
    df['Facebook Conversion Category'] = df['Facebook Ad Conversions'].apply(lambda x: 'zero' if x==0 else ('low' if x < q.loc[0.25] else ('medium' if x < q.loc[0.75] else 'high')))
if 'AdWords Ad Conversions' in df.columns:
    q2 = df['AdWords Ad Conversions'].quantile([0.25,0.75])
    df['AdWords Conversion Category'] = df['AdWords Ad Conversions'].apply(lambda x: 'zero' if x==0 else ('low' if x < q2.loc[0.25] else ('medium' if x < q2.loc[0.75] else 'high')))

fb_cat = df['Facebook Conversion Category'].value_counts().reset_index()
fb_cat.columns = ['Category','Count']
ad_cat = df['AdWords Conversion Category'].value_counts().reset_index()
ad_cat.columns = ['Category','Count']

c1, c2 = st.columns(2)
with c1:
    st.write("Facebook conversion categories")
    st.table(fb_cat)
    fig1 = px.pie(fb_cat, names='Category', values='Count', title='Facebook conversion categories')
    st.plotly_chart(fig1, use_container_width=True)
with c2:
    st.write("AdWords conversion categories")
    st.table(ad_cat)
    fig2 = px.pie(ad_cat, names='Category', values='Count', title='AdWords conversion categories')
    st.plotly_chart(fig2, use_container_width=True)

st.subheader("Correlation heatmap (Altair)")
corr = df.select_dtypes(include=[np.number]).corr().reset_index().melt('index')
corr.columns = ['feature_x','feature_y','value']
chart = alt.Chart(corr).mark_rect().encode(
    x='feature_x:O',
    y='feature_y:O',
    color='value:Q',
    tooltip=['feature_x','feature_y','value']
).properties(width=700, height=500)
st.altair_chart(chart, use_container_width=True)