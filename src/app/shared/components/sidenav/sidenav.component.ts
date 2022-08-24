import { Component, Inject, OnInit } from '@angular/core';
import { DOCUMENT, Location } from '@angular/common';
import { Store } from '@ngrx/store';
import { State } from 'src/app/store';
import { selectItems } from 'src/app/store/selectors/shared.selectors';

@Component({
  selector: 'app-sidenav',
  templateUrl: './sidenav.component.html',
  styleUrls: ['./sidenav.component.scss']
})
export class SidenavComponent implements OnInit {

  itens: Array<any> = []
  subItem = 0
  toggleNav: boolean = false
  toggleSub: boolean = false
  icon!: string
  location: Location
  window: Window | any


  constructor(
    location: Location, 
    @Inject(DOCUMENT) private document: Document,
    private store: Store<State>) { 
    this.location = location
    this.window = this.document.defaultView
  }

  ngOnInit(): void {
    this.store.select(selectItems).subscribe((data: any) => this.itens = data)
    this.icon = this.window.global_.logo
  }

}
