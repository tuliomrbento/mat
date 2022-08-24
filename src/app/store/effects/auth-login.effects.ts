import { Injectable } from '@angular/core';
import { Actions, createEffect, ofType } from '@ngrx/effects';
import { catchError, map, concatMap, tap } from 'rxjs/operators';
import { of } from 'rxjs';

import * as AuthLoginActions from '../actions/auth-login.actions';
import { AuthService } from 'src/app/services/authentication/auth.service';
import { Router } from '@angular/router';

@Injectable()
export class AuthLoginEffects {

  login$ = createEffect(() => {
    return this.actions$.pipe(
      ofType(AuthLoginActions.login),
      concatMap( (action) =>
        this.serviceAuth.login(action.username, action.password).pipe(
          map((data) => 
            AuthLoginActions.loginSuccess({ data: data.body }),
          ),
          catchError(error => 
            of(AuthLoginActions.loginFailure({ error: error.body }))
          )
        )
      )
    )
  })

  constructor(private actions$: Actions, private serviceAuth: AuthService, private router: Router) {}

}
