import { Component, Input, OnInit } from '@angular/core';
import { NgForm } from '@angular/forms';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { Store } from '@ngrx/store';
import { CampainService } from 'src/app/services/campain/campain.service';
import { State } from 'src/app/store';
import { loadStepsCampain } from 'src/app/store/actions/campain.actions';

@Component({
  selector: 'app-add-kpi',
  templateUrl: './add-kpi.component.html',
  styleUrls: ['./add-kpi.component.scss']
})
export class AddKpiComponent implements OnInit {

  @Input() data: any
  name!: string
  profile: string = ''
  region: string = ''
  sub_region: string = ''
  entry_key!: string
  allMetrics!: any

  constructor(
    public activeModal: NgbActiveModal, 
    private campainService: CampainService,
    private store: Store<State>
  ) { }

  ngOnInit(): void {
    this.allMetrics = this.data.metrics
    
    if(this.data.edit){
      this.name = this.data.edit.name
      this.profile = this.data.edit.profile
      this.region = this.data.edit.region
      this.sub_region = this.data.edit.sub_region
      this.entry_key = this.data.edit.entry_key
    }
  }

  handleDisabled(): boolean {
    if(this.name && this.profile && this.region && this.sub_region){
      return true
    }else {
      return false
    }
  }

  onSubmit(f: NgForm){
    if(this.data.edit){
      this.allMetrics.find((el: any) => {
        if(el.id == this.data.edit.id){
          el.name = this.name 
          el.profile = this.profile
          el.region = this.region 
          el.sub_region = this.sub_region 
          el.entry_key = this.entry_key
        }
      })
    }else {
      this.allMetrics.push({
        id: Date.now(),
        name: this.name,
        profile: this.profile,
        region: this.region,
        sub_region: this.sub_region,
        entry_key: this.entry_key ? this.entry_key : false,
        variables: [],
        calculation: [],
        awards: []
      })
    }

    this.campainService.addMetrics({
      id_etapa: this.data.id,
      kpi: this.allMetrics
    }).subscribe((res:any) => {
      if(res.status == 202){
        this.store.dispatch(loadStepsCampain())
        this.activeModal.dismiss()
      }
    })
  }

}
