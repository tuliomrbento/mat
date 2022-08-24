import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { CampainStepsManagementComponent } from 'src/app/pages/dashboard/campain-steps-management/campain-steps-management.component';
import { CampainStepsComponent } from 'src/app/pages/dashboard/campain-steps/campain-steps.component';

import { CampainComponent } from 'src/app/pages/dashboard/campain/campain.component';
import { ParticipantsComponent } from 'src/app/pages/dashboard/participants/participants.component';
import { HomeComponent } from 'src/app/pages/home/home.component';
import { ImportParticipantsComponent } from 'src/app/pages/import/import-participants/import-participants.component';
import { ImportResultsComponent } from 'src/app/pages/import/import-results/import-results.component';

const routes: Routes = [{
  path: 'dashboard',
  children: [
    { path: 'home', component: HomeComponent, },
    { path: 'campain', component: CampainComponent, },
    { path: 'campain/steps/:step', component: CampainStepsComponent },
    { path: 'campain/steps/:step/management/:metric', component: CampainStepsManagementComponent },
    { path: 'campain/import', component: ImportResultsComponent },
    { path: 'participants', component: ParticipantsComponent },
    { path: 'participants/import', component: ImportParticipantsComponent }
  ]},
  { path: '**', redirectTo: '/dashboard/home' }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class LazyLoadingRoutingModule { }
