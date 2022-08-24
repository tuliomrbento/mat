import { Component, OnInit } from '@angular/core';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { Store } from '@ngrx/store';
import { State } from 'src/app/store';
import { AddStepComponent } from './add-step/add-step.component';
import { selectSteps } from 'src/app/store/selectors/campain.selectors';
import { maskDateHyphen } from 'src/app/shared/helpers/hooks';
import { CampainService } from 'src/app/services/campain/campain.service';
import { loadStepsCampain } from 'src/app/store/actions/campain.actions';

@Component({
  selector: 'app-campain',
  templateUrl: './campain.component.html',
  styleUrls: ['./campain.component.scss']
})
export class CampainComponent implements OnInit {

  steps!: Array<any>
  now: string = new Date().toISOString().slice(0,10)
  maskDateHyphen = maskDateHyphen

  constructor(
    private modalService: NgbModal, 
    private store: Store<State>,
    private campainService: CampainService  
  ) { }

  ngOnInit(): void {
    this.store.select(selectSteps).subscribe((steps) => this.steps = steps)
  }

  openModal(){
    const modalRef = this.modalService.open(AddStepComponent, { centered: true })
  }

  handleDelete(id: any): void {
    this.campainService.deleteStep(id).subscribe(
      (res: any) => {
        if(res == 202){
          this.store.dispatch(loadStepsCampain())
        }
      }
    )
  }

}
