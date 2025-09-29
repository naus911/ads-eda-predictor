# 🤖 Marketing Data Science Studio — EDA, Econometrics & Predictive Pipelines

[![Streamlit App](https://img.shields.io/badge/Streamlit-Deployed-brightgreen)](https://ads-eda-predictor.streamlit.app/)  
[![GitHub Repo](https://img.shields.io/badge/GitHub-Code-blue)](https://github.com/Imswappy/ads-eda-predictor)

---

## 📌 Overview

This project extends Jupyter notebook analyses into an **interactive Streamlit dashboard** for **marketing campaign analytics**.  
It integrates **fundamentals of data exploration**, **statistical inference**, **econometrics tests**, and **machine learning pipelines**.  

The focus is on comparing **Facebook Ads** vs **AdWords Ads** campaigns — analyzing clicks, conversions, costs, and predicting ad performance.

🔗 **Live App:** [ads-eda-predictor.streamlit.app](https://ads-eda-predictor.streamlit.app/)  
🔗 **Source Code:** [github.com/Imswappy/ads-eda-predictor](https://github.com/Imswappy/ads-eda-predictor)

---

## 📂 Pages in the App

### 1️⃣ Dashboard — KPIs & Time-Series
- **KPIs:**
  - Mean:  
    $$\bar{X} = \frac{1}{n}\sum_{i=1}^n X_i$$
  - Variance:  
    $$s^2 = \frac{1}{n-1}\sum_{i=1}^n (X_i - \bar{X})^2$$
  - Standard Error:  
    $$\text{SEM} = \frac{s}{\sqrt{n}}$$
- **Time-series:** detects seasonality, trends, and structural breaks.
- **Scatter + OLS Regression:**
  $$\hat\beta_1 = \frac{\sum (X_i - \bar X)(Y_i - \bar Y)}{\sum (X_i - \bar X)^2},\qquad \hat\beta_0 = \bar Y - \hat\beta_1 \bar X.$$

---

### 2️⃣ Exploratory Data Analysis (EDA)
- **Distributions & Moments:**
  - Skewness:  
    $$\text{Skew} = \frac{1}{n}\sum\left(\frac{X_i - \bar X}{s}\right)^3$$
  - Kurtosis:  
    $$\text{Kurt} = \frac{1}{n}\sum\left(\frac{X_i - \bar X}{s}\right)^4$$
- **Histogram & KDE:**
  $$\hat f(x) = \frac{1}{nh}\sum_{i=1}^n K\left(\frac{x - X_i}{h}\right)$$
- **Correlation (Pearson):**
  $$r_{XY} = \frac{\sum (X_i - \bar X)(Y_i - \bar Y)}{\sqrt{\sum (X_i - \bar X)^2}\sqrt{\sum (Y_i - \bar Y)^2}}.$$

---

### 3️⃣ Statistical Tests & Regression Diagnostics
- **ADF (Stationarity):**
  $$\Delta Y_t = \alpha + \beta t + \gamma Y_{t-1} + \sum_{i=1}^p \delta_i \Delta Y_{t-i} + \varepsilon_t.$$
- **Cointegration (Engle-Granger):**
  - Regress residuals and check for stationarity.
- **Breusch–Pagan Test (Heteroscedasticity):**
  $$H_0: \text{Var}(\varepsilon) = \sigma^2 \quad vs \quad H_1: \text{Var}(\varepsilon) = f(X)$$
- **Diagnostics:** residual plots, robust SEs, adjusted $$R^2$$, AIC/BIC.

---

### 4️⃣ Notebook Reproductions
- Replicates matplotlib & seaborn plots for **validation**.
- **LOWESS smoothing:**  
  $$\hat f(x_0) = \arg\min_\beta \sum w_i(x_0)(y_i - \beta_0 - \beta_1 x_i)^2$$  
  where weights decay with distance from $$x_0$$.

---

### 5️⃣ Predictor — Pipelines, CV & Model Persistence
- **Preprocessing (ColumnTransformer):**
  - Numeric: Median imputation + scaling.  
    - StandardScaler: $$X' = \frac{X - \mu}{\sigma}$$  
    - MinMaxScaler: $$X' = \frac{X - X_{\min}}{X_{\max}-X_{\min}}$$
  - Categorical: Rare-category grouping → most-frequent imputation → OneHotEncoding.

- **Models:**
  - Linear Regression (OLS)  
  - Ridge (L2):  
    $$\min_\beta \sum (y_i - X_i\beta)^2 + \alpha \|\beta\|_2^2$$
  - Lasso (L1):  
    $$\min_\beta \sum (y_i - X_i\beta)^2 + \alpha \|\beta\|_1$$
  - Random Forest (Ensemble):  
    $$\hat f(x) = \frac{1}{B}\sum_{b=1}^B T_b(x)$$

- **Evaluation:**
  - RMSE:  
    $$\text{RMSE} = \sqrt{\frac{1}{n}\sum (y_i - \hat y_i)^2}$$
  - $$R^2 = 1 - \frac{\sum (y_i - \hat y_i)^2}{\sum (y_i - \bar y)^2}$$
- **Persistence:** trained pipelines saved with `joblib` for reuse.

---

## 🚀 Deployment
- Built with **Streamlit** (multi-page app).  
- Deployed on **Streamlit Cloud**: [ads-eda-predictor.streamlit.app](https://ads-eda-predictor.streamlit.app/)  
- Repository: [github.com/Imswappy/ads-eda-predictor](https://github.com/Imswappy/ads-eda-predictor)

---

## 🛠️ Skills Involved
- **Python** (pandas, numpy, matplotlib, seaborn)  
- **Machine Learning** (Linear/Ridge/Lasso, Random Forest, pipelines, CV)  
- **Statistical Inference** (ADF, Cointegration, Breusch–Pagan, OLS diagnostics)  
- **Data Visualization** (Plotly, Altair, Seaborn, Matplotlib)  
- **Streamlit** (multi-page UI, state management, deployment)  
- **Model Deployment** (joblib persistence, end-to-end reproducibility)

---

## 📸 Screenshots
<img width="1497" height="796" alt="image" src="https://github.com/user-attachments/assets/8524dc73-96d1-4c47-9a38-c8f8544e05a9" />
<img width="1436" height="744" alt="image" src="https://github.com/user-attachments/assets/2f69ae95-1646-4012-9368-928f434eaf85" />
<img width="1493" height="835" alt="image" src="https://github.com/user-attachments/assets/903d21b1-0036-4548-b15b-7cbd570b85c4" />
<img width="1518" height="763" alt="image" src="https://github.com/user-attachments/assets/92442c98-216b-45e5-aa71-0d3618239184" />
<img width="1509" height="737" alt="image" src="https://github.com/user-attachments/assets/bbb29443-37d9-4c57-b5ae-97720f41526e" />
<img width="1118" height="772" alt="image" src="https://github.com/user-attachments/assets/60140940-ec0c-439b-83cc-55e0f4114ed5" />
<img width="1448" height="824" alt="image" src="https://github.com/user-attachments/assets/859abd78-8d6d-43fa-bac7-03a6e87fde18" />
<img width="1581" height="860" alt="image" src="https://github.com/user-attachments/assets/f99a9c8d-1c7d-460a-89c7-ace6cfd7e5a2" />
<img width="1697" height="835" alt="image" src="https://github.com/user-attachments/assets/a31f0ecd-2470-4876-a37d-be00c3936aee" />

---

## ⚡ Getting Started

```bash
# Clone repo
git clone https://github.com/Imswappy/ads-eda-predictor.git
cd ads-eda-predictor

# Install dependencies
pip install -r requirements.txt

# Run Streamlit app locally
streamlit run streamlit_app.py
