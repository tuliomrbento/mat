import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { LoginComponent } from './pages/login/login.component';
import { TemplateComponent } from './shared/components/template/template.component';
import { AuthGuardService } from './services/authentication/auth-guard.service';

const routes: Routes = [
  { path: 'login', component: LoginComponent },
  {
    path: '', component: TemplateComponent,
    canActivate: [ AuthGuardService ],
    loadChildren: () => import('./modules/lazy-loading/lazy-loading.module').then((modules) => modules.LazyLoadingModule)
  },
  { path: '**', redirectTo: '/dashboard/home' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
