import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { StoreModule } from '@ngrx/store';
import * as fromAuthLogin from '../../store/reducers/auth-login.reducer';
import { EffectsModule } from '@ngrx/effects';
import { AuthLoginEffects } from '../../store/effects/auth-login.effects';

@NgModule({
  declarations: [],
  imports: [
    CommonModule,
    StoreModule.forFeature(fromAuthLogin.authLoginFeatureKey, fromAuthLogin.reducer),
    EffectsModule.forFeature([AuthLoginEffects])
  ]
})
export class AuthLoginModule { }
