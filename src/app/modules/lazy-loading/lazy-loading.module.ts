import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { MaterialModule } from '../material/material.module';
import { BsDropdownModule } from 'ngx-bootstrap/dropdown';
import { TooltipModule } from 'ngx-bootstrap/tooltip';
import { ModalModule } from 'ngx-bootstrap/modal';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { NgxMaskModule, IConfig } from 'ngx-mask'

import { LazyLoadingRoutingModule } from './lazy-loading-routing.module';

import { HomeComponent } from 'src/app/pages/home/home.component';
import { TemplateComponent } from 'src/app/shared/components/template/template.component';
import { SidenavComponent } from '../../shared/components/sidenav/sidenav.component';
import { ParticipantsComponent } from '../../pages/dashboard/participants/participants.component';
import { CampainComponent } from '../../pages/dashboard/campain/campain.component';
import { ImportParticipantsComponent } from '../../pages/import/import-participants/import-participants.component';
import { ModalComponent } from '../../pages/dashboard/participants/modal/modal.component';
import { FilterComponent } from '../../pages/dashboard/participants/filter/filter.component';
import { EmptyFilterComponent } from '../../pages/dashboard/participants/empty-filter/empty-filter.component';
import { EmptyTableComponent } from '../../pages/dashboard/participants/empty-table/empty-table.component';
import { MobileSidenavComponent } from '../../shared/components/mobile-sidenav/mobile-sidenav.component';
import { AddStepComponent } from '../../pages/dashboard/campain/add-step/add-step.component';
import { CampainStepsComponent } from '../../pages/dashboard/campain-steps/campain-steps.component';
import { AddKpiComponent } from '../../pages/dashboard/campain-steps/add-kpi/add-kpi.component';
import { CampainStepsManagementComponent } from '../../pages/dashboard/campain-steps-management/campain-steps-management.component';
import { CommandListComponent } from '../../pages/dashboard/campain-steps-management/command-list/command-list.component';
import { ImportResultsComponent } from '../../pages/import/import-results/import-results.component';

const maskConfig: Partial<IConfig> = {
  validation: false,
}

@NgModule({
  declarations: [
    HomeComponent,
    TemplateComponent,
    SidenavComponent,
    ParticipantsComponent,
    CampainComponent,
    ImportParticipantsComponent,
    ModalComponent,
    FilterComponent,
    EmptyFilterComponent,
    EmptyTableComponent,
    MobileSidenavComponent,
    AddStepComponent,
    CampainStepsComponent,
    AddKpiComponent,
    CampainStepsManagementComponent,
    CommandListComponent,
    ImportResultsComponent,
  ],
  imports: [
    NgxMaskModule.forRoot(maskConfig),
    CommonModule,
    LazyLoadingRoutingModule,
    MaterialModule,
    BsDropdownModule,
    TooltipModule,
    FormsModule,
    ReactiveFormsModule,
    ModalModule.forRoot()
  ]
})
export class LazyLoadingModule { }
