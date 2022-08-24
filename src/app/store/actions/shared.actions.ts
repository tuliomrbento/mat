import { createAction, props } from '@ngrx/store';

export const loadSharedProperties = createAction(
  '[Shared] Load Shared Properties'
);

export const loadSharedUser = createAction(
  '[Shared] Load User',
  props<{user: any}>()
)

export const loadSharedPropertiesSuccess = createAction(
  '[Shared] Load SharedProperties Success',
  props<{ data: any }>()
);

export const loadSharedPropertiesFailure = createAction(
  '[Shared] Load Shareds Failure',
  props<{ error: any }>()
);
