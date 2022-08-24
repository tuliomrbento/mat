import { createAction, props } from '@ngrx/store';

export const loadCampains = createAction(
  '[Campain] Load Campains'
);

export const loadCampainsSuccess = createAction(
  '[Campain] Load Campains Success',
  props<{ data: any }>()
);

export const loadCampainsFailure = createAction(
  '[Campain] Load Campains Failure',
  props<{ error: any }>()
);

export const loadImportsHistory = createAction(
  '[Campain] Imports History',
  props<{ imports: any }>()
)

export const loadStepsCampain = createAction(
  '[Campain] Load Steps'
)

export const loadStepsCampainSuccess = createAction(
  '[Campain] Success Load Steps',
  props<{ steps: any }>()
)