import { Injectable } from '@angular/core'
import { ActivatedRouteSnapshot, CanActivate, RouterStateSnapshot, UrlTree, Router } from '@angular/router'
import { Store } from '@ngrx/store'
import { Observable } from 'rxjs'
import { State } from 'src/app/store'

import { loadSharedProperties, loadSharedUser } from 'src/app/store/actions/shared.actions'
import { loadParticipants } from 'src/app/store/actions/participants.actions'

@Injectable({
  providedIn: 'root'
})
export class AuthGuardService implements CanActivate {

  constructor(private router: Router, private store: Store<State>) { }

  session: string = sessionStorage.getItem('user') || ''
  unserialize: string = this.session ? atob(unescape(encodeURIComponent(this.session))) : ''
  user: any = this.unserialize ? JSON.parse(this.unserialize) : ''

  canActivate(
    route: ActivatedRouteSnapshot,
    state: RouterStateSnapshot
  ): boolean | UrlTree | Observable<boolean | UrlTree> | Promise<boolean | UrlTree> {
    if (this.user.token){
      this.store.dispatch(loadSharedUser({user: this.user}))
      this.store.dispatch(loadSharedProperties())
      return true
    }else{
      this.router.navigate(['/login'])
      return false
    }
  }

}
