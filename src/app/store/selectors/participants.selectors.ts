import { createFeatureSelector, createSelector } from '@ngrx/store';
import * as fromParticipants from '../reducers/participants.reducer';

export const selectParticipantsState = createFeatureSelector<fromParticipants.State>(
  fromParticipants.participantsFeatureKey
);

export const selectAllParticipants = createSelector(
  selectParticipantsState,
  (state: fromParticipants.State) => state.allParticipants.participants
)

export const selectHeadParticipants = createSelector(
  selectParticipantsState,
  (state: fromParticipants.State) => state.allParticipants.head
)

export const selectQtds = createSelector(
  selectParticipantsState,
  (state: fromParticipants.State) => state.allParticipants.qtd
)

export const selectHasParticipants = createSelector(
  selectParticipantsState,
  (state: fromParticipants.State) => state.hasParticipants
)

export const selectStatus = createSelector(
  selectParticipantsState,
  (state: fromParticipants.State) => state.status
)

export const selectProfiles = createSelector(
  selectParticipantsState,
  (state: fromParticipants.State) => state.profiles
)

export const selectHasFilters = createSelector(
  selectParticipantsState, 
  (state: fromParticipants.State) => state.hasFilters
)


