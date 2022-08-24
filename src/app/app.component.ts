import { DOCUMENT } from '@angular/common';
import { Component, Inject, OnInit } from '@angular/core';
import { Title } from '@angular/platform-browser';
import { Store } from '@ngrx/store';
import { State } from './store';
import { selectColors } from './store/selectors/shared.selectors';
import * as SharedActions from './store/actions/shared.actions'
import * as ParticipantsActions from './store/actions/participants.actions'

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent implements OnInit {

  title: string = 'Pat Plataforma';
  icon: string = 'assets/favicon.svg';
  
  public constructor(
    private titleService: Title, 
    @Inject(DOCUMENT) private _document: Document,
    private store: Store<State>
  ) { 
      this.setTitle(this.title)
      this.setIcon(this.icon)
    }
  
    ngOnInit(): void {
    }
    
    public setTitle(newTitle: string) {
      this.titleService.setTitle(newTitle);
    }
    
    public setIcon(newPathIcon: string){
      this._document.getElementById('documentFavicon')?.setAttribute('href', newPathIcon);
    }
}
