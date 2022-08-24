import { Component, OnInit } from '@angular/core';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { Store } from '@ngrx/store';
import { State } from 'src/app/store';
import { selectItems } from 'src/app/store/selectors/shared.selectors';
import { MobileSidenavComponent } from '../mobile-sidenav/mobile-sidenav.component';
import * as fromAuth from '../../../store/actions/auth-login.actions'
import { selectAllCampains } from 'src/app/store/selectors/campain.selectors';

@Component({
  selector: 'app-template',
  templateUrl: './template.component.html',
  styleUrls: ['./template.component.scss']
})
export class TemplateComponent implements OnInit {

  items: Array<any> = []
  item: string = ''
  campain!: any

  constructor(private store: Store<State>, private modalService: NgbModal) { }

  ngOnInit(): void {
    this.store.select(selectItems).subscribe((data: any) => this.items = data)  
    this.store.select(selectAllCampains).subscribe((data) => this.campain = data) 
  }

  pathname(): string {
    this.items.map((element)=>{
      if(element.path.includes(location.pathname)){
        this.item = element.title
      }else {
        element.sub.map((el: any) => {
          if(el.path === location.pathname){
            this.item = el.title
          }else if(location.pathname.includes('campain')){
            this.item = 'Etapas da Campanha'
          }
        })
      }
    })
    return this.item
  }

  openMenu(){
    const modalRef = this.modalService.open(MobileSidenavComponent, { windowClass: 'leftnav', size: 'lg' })
    modalRef.componentInstance.data = this.logout
  }

  logout(): void {
    this.store.dispatch(fromAuth.logout())
    location.reload()
  }

}
