import { createAction, props } from '@ngrx/store';

export const login = createAction(
  '[AuthLogin] Auth Login',
  props<{ username: string; password: string }>()
);

export const logout = createAction(
  '[AuthLogin] Auth Logout',
);

export const loginSuccess = createAction(
  '[AuthLogin] Auth Login Success',
  props<{ data: any }>()
);

export const loginFailure = createAction(
  '[AuthLogin] Auth Login Failure',
  props<{ error: any }>()
);

export const toggleLoading = createAction(
  '[AuthLogin] Toggle Loading',
  props<{ loading: boolean }>()
)

export const toggleError = createAction(
  '[AuthLogin] Toggle Error',
  props<{ error: any }>()
)