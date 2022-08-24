import { Action, createReducer, on } from '@ngrx/store';
import * as AuthLoginActions from '../actions/auth-login.actions';

export const authLoginFeatureKey = 'authLogin';

export interface State {
  user: any,
  error: any,
  loading: boolean
}

export const initialState: State = {
  user: {},
  error: null,
  loading: false
};

export const reducer = createReducer(
  initialState,

  on(AuthLoginActions.login, state => state),
  
  on(AuthLoginActions.loginSuccess, (state, action: any) => {
    return {
      ...state,
      user: action,
      error: null,
    }
  }),

  on(AuthLoginActions.loginFailure, (state, action) => {
    return {
      ...state,
      user: {},
      error: action,
      loading: false
    }
  }),

  on(AuthLoginActions.toggleLoading, (state, action) => {
    return {
      ...state, 
      loading: action.loading
    }
  }),

  on(AuthLoginActions.toggleError, (state, action) => {
    return {
      ...state,
      error: action.error
    }
  })

);
