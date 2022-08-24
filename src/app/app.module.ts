import { NgModule, LOCALE_ID } from '@angular/core';

import { BrowserModule } from '@angular/platform-browser';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { AppRoutingModule } from './app-routing.module';
import { ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { MaterialModule } from './modules/material/material.module';
import { AuthLoginModule } from './modules/auth-login/auth-login.module';

import { AppComponent } from './app.component';
import { LoginComponent } from './pages/login/login.component';

import { ServiceWorkerModule } from '@angular/service-worker';
import { NgxMaskModule, IConfig } from 'ngx-mask'

import { environment } from '../environments/environment';

import { StoreModule } from '@ngrx/store';
import { StoreDevtoolsModule } from '@ngrx/store-devtools';
import { EffectsModule } from '@ngrx/effects';
import { reducers, metaReducers } from './store'
import { PersistUserEffects } from './store/effects/persist-user.effects';
import { ParticipantsEffects } from './store/effects/participants.effects';
import { CampainEffects } from './store/effects/campain.effects';
import { SharedEffects } from './store/effects/shared.effects';

const maskConfig: Partial<IConfig> = {
  validation: false,
}

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    NgbModule,
    AuthLoginModule,
    MaterialModule,
    BrowserAnimationsModule,
    ReactiveFormsModule,
    NgxMaskModule.forRoot(maskConfig),
    StoreModule.forRoot(reducers, {
      metaReducers,
      runtimeChecks: {
        strictStateImmutability: false,
        strictActionImmutability: false,
        strictStateSerializability: true,
        strictActionSerializability: true,
        strictActionWithinNgZone: true,
        strictActionTypeUniqueness: true,
      },
     }),
     EffectsModule.forRoot([ 
      PersistUserEffects,
      ParticipantsEffects,
      CampainEffects,
      SharedEffects
    ]),
    !environment.production ? StoreDevtoolsModule.instrument() : [],
    StoreDevtoolsModule.instrument({ maxAge: 25, logOnly: environment.production }),
    ServiceWorkerModule.register('ngsw-worker.js', {
      enabled: environment.production,
      registrationStrategy: 'registerWhenStable:30000'
    }),
    
  ],
  providers: [{ provide: LOCALE_ID, useValue: 'pt-BR' }],
  bootstrap: [AppComponent]
})
export class AppModule { }
