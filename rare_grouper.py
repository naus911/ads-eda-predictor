# rare_grouper.py
import pandas as pd
from sklearn.base import BaseEstimator, TransformerMixin


class RareCategoryGrouper(BaseEstimator, TransformerMixin):
    """
    RareCategoryGrouper(groups):
      groups: dict mapping column name -> {'min_freq': float between 0 and 1 or None,
                                         'top_k': int or None}
    In transform, replace categories not meeting these criteria with '__OTHER__'.
    Works on pandas DataFrame (expects column order with those keys present).
    """
    def __init__(self, groups=None):
        self.groups = groups or {}
        self.frequent_categories_ = {}

    def fit(self, X, y=None):
        if not isinstance(X, pd.DataFrame):
            X = pd.DataFrame(X)
        for col, opts in (self.groups.items()):
            if col not in X.columns:
                self.frequent_categories_[col] = None
                continue
            series = X[col].astype(str).fillna("__NA__")
            min_freq = opts.get('min_freq', None)
            top_k = opts.get('top_k', None)
            freqs = series.value_counts(normalize=True)
            keep = set()
            if min_freq is not None:
                keep.update(freqs[freqs >= min_freq].index.tolist())
            if top_k is not None and top_k > 0:
                topk = freqs.index.tolist()[:top_k]
                keep.update(topk)
            if min_freq is None and (top_k is None or top_k <= 0):
                keep = set(freqs.index.tolist())
            self.frequent_categories_[col] = keep
        return self

    def transform(self, X):
        if not isinstance(X, pd.DataFrame):
            X = pd.DataFrame(X)
        X = X.copy()
        for col, keep in self.frequent_categories_.items():
            if keep is None or col not in X.columns:
                continue
            series = X[col].astype(str).fillna("__NA__")
            X[col] = series.apply(lambda v: v if v in keep else "__OTHER__")
        return X
