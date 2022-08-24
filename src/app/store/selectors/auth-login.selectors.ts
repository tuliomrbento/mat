import { createFeatureSelector, createSelector } from '@ngrx/store';
import * as fromAuthLogin from '../reducers/auth-login.reducer';

export const selectAuthLoginState = createFeatureSelector<fromAuthLogin.State>(
  fromAuthLogin.authLoginFeatureKey
);

export const selectAuthError = createSelector(
  selectAuthLoginState,
  (state: fromAuthLogin.State) => state.error
)

export const selectAuthLoading = createSelector(
  selectAuthLoginState, 
  (state: fromAuthLogin.State) => state.loading
)