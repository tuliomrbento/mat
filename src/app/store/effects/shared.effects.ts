import { Injectable } from '@angular/core';
import { Actions, createEffect, ofType } from '@ngrx/effects';
import { Store } from '@ngrx/store';
import { EMPTY } from 'rxjs';
import { catchError, mergeMap, map, tap } from 'rxjs/operators';
import { BaseConfigService } from 'src/app/services/base-config/base-config.service';
import { State } from '..';

import * as SharedActions from '../actions/shared.actions'
import * as CampainActions from '../actions/campain.actions'
import * as ParticipantsActions from '../actions/participants.actions'
import { selectUser } from '../selectors/shared.selectors';

@Injectable()
export class SharedEffects {

  user$!: any

  loadSharedPropertiesColors$ = createEffect(() =>
    this.actions$.pipe(
      ofType(SharedActions.loadSharedProperties),
      mergeMap(() => this.baseConfigService.getProperties(this.user$.empresa).pipe(
        map((data: any) => CampainActions.loadCampainsSuccess({data: data})),
        catchError(() => EMPTY)
      )),
    )
  )  



  constructor(
    private actions$: Actions, 
    private baseConfigService: BaseConfigService,
    private store: Store<State>
  ) {
    this.store.select(selectUser).subscribe((user) => this.user$ = user)
  }

}
