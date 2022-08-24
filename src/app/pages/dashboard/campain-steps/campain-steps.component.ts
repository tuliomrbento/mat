import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { Store } from '@ngrx/store';
import { State } from 'src/app/store';
import { selectSteps } from 'src/app/store/selectors/campain.selectors';
import { AddKpiComponent } from './add-kpi/add-kpi.component';
import { maskDate } from 'src/app/shared/helpers/hooks';
import { Location } from '@angular/common';
import { CampainService } from 'src/app/services/campain/campain.service';
import { loadStepsCampain } from 'src/app/store/actions/campain.actions';

@Component({
  selector: 'app-campain-steps',
  templateUrl: './campain-steps.component.html',
  styleUrls: ['./campain-steps.component.scss']
})
export class CampainStepsComponent implements OnInit {

  kpis: Array<any> = []
  id!: string
  step!: any
  maskDate = maskDate

  constructor(
    private modalService: NgbModal, 
    private route: ActivatedRoute,
    private store: Store<State>,
    private location: Location,
    private campainService: CampainService
  ) { }

  ngOnInit(): void {
    this.route.params.subscribe((parameter) => this.id = parameter.step)
    this.store.select(selectSteps).subscribe((data) => this.step = data.find((el:any) => el.id == this.id))
  }

  openModal(){
    const modalRef = this.modalService.open(AddKpiComponent, { centered: true })
    modalRef.componentInstance.data = {
      id: this.step.id,
      metrics: this.step.metrics
    }
  }

  toBack(): void{
    this.location.back()
  }

  copyMetric(metric: any){
    this.step.metrics.push({
      id: Date.now(),
      name: metric.name + ' Cópia',
      profile: metric.profile,
      region: metric.region,
      sub_region: metric.sub_region,
      entry_key: metric.entry_key,
      variables: [],
      calculation: [],
      awards: []
    })
    
    this.campainService.addMetrics({
      id_etapa: this.step.id,
      kpi: this.step.metrics
    }).subscribe((res:any) => {
      if(res.status == 202){
        this.store.dispatch(loadStepsCampain())
      }
    })
  }

  deleteMetric(id: any) {
    this.campainService.addMetrics({
      id_etapa: this.step.id,
      kpi: this.step.metrics.filter((el:any) => el.id !== id)
    }).subscribe((res:any) => {
      if(res.status == 202){
        this.store.dispatch(loadStepsCampain())
      }
    })
  }

  editMetric(metric: any) {
    const modalRef = this.modalService.open(AddKpiComponent, { centered: true })
    modalRef.componentInstance.data = {
      id: this.step.id,
      metrics: this.step.metrics,
      edit: metric
    }
  }

}
