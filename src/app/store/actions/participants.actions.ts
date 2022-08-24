import { createAction, props } from '@ngrx/store';

export const loadParticipants = createAction(
  '[Participants] Participants Load',
);

export const updateParticipants = createAction(
  '[Participants] Participants Update',
  props<{ params: any }>()
);

export const participantsSuccess = createAction(
  '[Participants] Participants Success',
  props<{ participants: any }>()
);

export const participantsFailure = createAction(
  '[Participants] Participants Failure',
  props<{ error: any }>()
);

export const toggleFilters = createAction(
  '[Participants] Filters',
  props<{value: boolean}>()
)

export const loadParticipantsFiltered = createAction(
  '[Participants] Load Participants Filtered',
  props<{participants: any}>()
)