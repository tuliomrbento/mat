import { Injectable } from '@angular/core';
import { Actions, createEffect, ofType } from '@ngrx/effects';
import { catchError, map, concatMap, tap, mergeMap } from 'rxjs/operators';
import { Observable, EMPTY, of } from 'rxjs';

import * as CampainActions from '../actions/campain.actions';
import * as ParticipantsActions from '../actions/participants.actions'
import * as AuthLoginActions from '../actions/auth-login.actions'
import * as SharedActions from '../actions/shared.actions'

import { Store } from '@ngrx/store';
import { State } from '..';
import { selectAllCampains } from '../selectors/campain.selectors';
import { ParticipantsService } from 'src/app/services/participants/participants.service';
import { HistoryImportsService } from 'src/app/services/imports/history-imports.service';
import { CampainService } from 'src/app/services/campain/campain.service';

@Injectable()
export class CampainEffects {
  
  campain: any = {}

  loadStepsCampain$ = createEffect(() => {
    return this.actions$.pipe( 
      ofType(CampainActions.loadStepsCampain),
      mergeMap(() => this.campainSerive.getAllSteps(this.campain.id).pipe(
        map((data: any) => CampainActions.loadStepsCampainSuccess({ steps: data })),
        catchError(error => of(CampainActions.loadCampainsFailure({ error: 'Erro ao carregar steps' })))
      ))
    )
  })

  loadParticipantsCampain$ = createEffect(() =>{
    return this.actions$.pipe(
      ofType(CampainActions.loadCampainsSuccess),
      mergeMap(() => this.participantsService.getAll({params : {
        id_campanha: this.campain.id,
        pg: 0,
        limit: 10,
        filter: []
      }}).pipe(
        map((data: any) => ParticipantsActions.participantsSuccess({ participants: data })),
        catchError(error => of(ParticipantsActions.participantsFailure({ error: 'Erro ao carregar' })))
      )),
      tap(() => this.store.dispatch(CampainActions.loadStepsCampain()))
    )
  })


  constructor(
    private actions$: Actions, 
    private participantsService: ParticipantsService,
    private campainSerive: CampainService,
    private store: Store<State>
  ) { 
    this.store.select(selectAllCampains).subscribe((data) => this.campain = data)
  }

}
