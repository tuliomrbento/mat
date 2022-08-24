import { Component, OnInit } from '@angular/core';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { Store } from '@ngrx/store';
import { State } from 'src/app/store';
import { selectItems } from 'src/app/store/selectors/shared.selectors';
import * as fromAuth from 'src/app/store/actions/auth-login.actions'

@Component({
  selector: 'app-mobile-sidenav',
  templateUrl: './mobile-sidenav.component.html',
  styleUrls: ['./mobile-sidenav.component.scss']
})
export class MobileSidenavComponent implements OnInit {

  items: Array<any> = []

  constructor(public activeModal: NgbActiveModal, private store: Store<State>) { }

  ngOnInit(): void {
    this.store.select(selectItems).subscribe((data: any) => this.items = data)
  }
  
  logout():void{
    this.store.dispatch(fromAuth.logout())
    location.reload()
  }

}
