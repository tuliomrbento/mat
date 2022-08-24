import { Injectable } from '@angular/core';
import { Actions, createEffect, ofType } from '@ngrx/effects';
import { tap } from 'rxjs/operators';

import * as AuthLoginActions from '../actions/auth-login.actions';

@Injectable()
export class PersistUserEffects {

  addSessionStorage$ = createEffect(() =>
    this.actions$.pipe(
      ofType(AuthLoginActions.loginSuccess),
      tap((action) => {
        sessionStorage.setItem('user', btoa(JSON.stringify(action.data)))
        sessionStorage.setItem('token', btoa(JSON.stringify(action.data.token)))
        window.location.pathname = '/'
      })
    ), {dispatch: false}
  )

  removeSessionStorage$ = createEffect(
    () =>
      this.actions$.pipe(
        ofType(AuthLoginActions.logout),
        tap(() => {
          sessionStorage.removeItem('user')
          sessionStorage.removeItem('token')
        }),
      ),
    { dispatch: false }
  )

  constructor(private actions$: Actions) {}

}
