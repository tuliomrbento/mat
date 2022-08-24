import { createFeatureSelector, createSelector } from '@ngrx/store';
import * as fromShared from '../reducers/shared.reducer'

export const selectSharedState = createFeatureSelector<fromShared.State>(
  fromShared.sharedFeatureKey
)

export const selectUser = createSelector(
  selectSharedState,
  (state: fromShared.State) => state.user
)

export const selectItems = createSelector(
  selectSharedState,
  (state: fromShared.State) => state.itemsByPages
)

export const selectColors = createSelector(
  selectSharedState,
  (state: fromShared.State) => state.properties
)