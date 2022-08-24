import { Injectable } from '@angular/core';
import { Actions, createEffect, ofType } from '@ngrx/effects';
import { catchError, map, concatMap, delay, mergeMap } from 'rxjs/operators';
import { Observable, EMPTY, of } from 'rxjs';

import * as ParticipantsActions from '../actions/participants.actions';
import * as AuthLoginActions from '../actions/auth-login.actions'
import * as SharedActions from '../actions/shared.actions'

import { ParticipantsService } from 'src/app/services/participants/participants.service';
import { Store } from '@ngrx/store';
import { State } from '..';
import { selectAllCampains } from '../selectors/campain.selectors';


@Injectable()
export class ParticipantsEffects {

  updateParticipants$ = createEffect(() => {
    return this.actions$.pipe(
      ofType(ParticipantsActions.updateParticipants),
      mergeMap((action) => this.participantsService.getAll({params : action}).pipe(
        map((data: any) => ParticipantsActions.participantsSuccess({ participants: data })),
        catchError(error => of(ParticipantsActions.participantsFailure({ error: 'Erro ao carregar' })))
      ))
    )
  });

  constructor(
    private actions$: Actions, 
    private participantsService: ParticipantsService,
  ) { 
  }

}
