import { Component, OnInit } from '@angular/core';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { Store } from '@ngrx/store';
import { CampainService } from 'src/app/services/campain/campain.service';
import { State } from 'src/app/store';
import { loadStepsCampain } from 'src/app/store/actions/campain.actions';
import { selectAllCampains } from 'src/app/store/selectors/campain.selectors';

@Component({
  selector: 'app-add-step',
  templateUrl: './add-step.component.html',
  styleUrls: ['./add-step.component.scss']
})
export class AddStepComponent implements OnInit {

  start: string = ''
  end: string = ''
  hyphen: string = ''
  name: string = ''
  isInvalid: boolean = false
  campain!: any

  constructor(
    public activeModal: NgbActiveModal, 
    private campainService: CampainService,
    private store: Store<State>  
  ) { }

  ngOnInit(): void {
    this.store.select(selectAllCampains).subscribe((data) => this.campain = data)
  }

  handleDateRange(startDate: HTMLInputElement, endDate: HTMLInputElement){
    this.hyphen = '-'
    this.start = startDate.value
    this.end = endDate.value
    //console.log(new Date(startDate.value).toISOString().slice(0, 19).replace('T', ' '), new Date(endDate.value).toISOString().slice(0, 19).replace('T', ' '))
  }

  handleNameTitle(nameTitle:HTMLInputElement){
    this.name = nameTitle.value
  }

  create(){
    if(!this.name){
      this.isInvalid = true
    }else{
      this.isInvalid = false
      this.campainService.addStepCampain({
        id_campanha: this.campain.id,
        nome: this.name,
        inicio_em: this.start.replace(/[/]/g,'-').split(/\D/).reverse().join('-'),
        termina_em: this.end.replace(/[/]/g,'-').split(/\D/).reverse().join('-')
      }).subscribe((res:any) => {
        if(res.status == 202){
          this.store.dispatch(loadStepsCampain())
          this.activeModal.dismiss()
        }
      })
    }
  }

}
