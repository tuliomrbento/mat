import { createFeatureSelector, createSelector } from '@ngrx/store';
import * as fromCampain from '../reducers/campain.reducer';

export const selectCampainState = createFeatureSelector<fromCampain.State>(
  fromCampain.campainFeatureKey
);

export const selectAllCampains = createSelector(
  selectCampainState,
  (state: fromCampain.State) => state.allCampains
)

export const selectSteps = createSelector(
  selectCampainState,
  (state: fromCampain.State) => state.steps
)

export const selectImportsParticipants = createSelector(
  selectCampainState, 
  (state: fromCampain.State) => state.imports
)