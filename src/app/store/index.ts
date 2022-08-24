import {
  ActionReducer,
  ActionReducerMap,
  createFeatureSelector,
  createSelector,
  MetaReducer
} from '@ngrx/store';
import { environment } from '../../environments/environment';
import * as fromAuthLogin from './reducers/auth-login.reducer';
import * as fromShared from './reducers/shared.reducer';
import * as fromParticipants from './reducers/participants.reducer';
import * as fromCampain from './reducers/campain.reducer'

export interface State {
  [fromAuthLogin.authLoginFeatureKey]: fromAuthLogin.State;
  [fromShared.sharedFeatureKey]: fromShared.State
  [fromParticipants.participantsFeatureKey]: fromParticipants.State;
  [fromCampain.campainFeatureKey]: fromCampain.State;
}

export const reducers: ActionReducerMap<State> = {
  [fromAuthLogin.authLoginFeatureKey]: fromAuthLogin.reducer,
  [fromShared.sharedFeatureKey]: fromShared.reducer,
  [fromParticipants.participantsFeatureKey]: fromParticipants.reducer,
  [fromCampain.campainFeatureKey]: fromCampain.reducer,
}

export const metaReducers: MetaReducer<State>[] = !environment.production ? [debug] : [];

export function debug(reducer: ActionReducer<any>): ActionReducer<any> {
  return (state: any, action: any) =>  {
    return reducer(state, action)
  }
}