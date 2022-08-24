import { Component, OnInit, ElementRef, QueryList, ViewChildren } from '@angular/core'
import { NgbModal } from '@ng-bootstrap/ng-bootstrap'
import { CommandListComponent } from './command-list/command-list.component'
import {COMMA, ENTER} from '@angular/cdk/keycodes'
import {FormControl, NgForm} from '@angular/forms'
import {MatAutocompleteSelectedEvent} from '@angular/material/autocomplete'
import {MatChipInputEvent} from '@angular/material/chips'
import {Observable} from 'rxjs'
import {map, startWith} from 'rxjs/operators'
import { ActivatedRoute } from '@angular/router'
import { Store } from '@ngrx/store'
import { State } from 'src/app/store'
import { selectSteps } from 'src/app/store/selectors/campain.selectors'
import { Location } from '@angular/common'
import { loadStepsCampain } from 'src/app/store/actions/campain.actions'
import { CampainService } from 'src/app/services/campain/campain.service'

@Component({
  selector: 'app-campain-steps-management',
  templateUrl: './campain-steps-management.component.html',
  styleUrls: ['./campain-steps-management.component.scss','../campain-steps/campain-steps.component.scss']
})
export class CampainStepsManagementComponent implements OnInit {

  allVariables: any = []
  variableType: any = {
    number: 'assets/icons/number.svg',
    boolean: 'assets/icons/boolean.svg',
    currency: 'assets/icons/currency.svg',
    string: 'assets/icons/questionmarkfilled.svg'
  }
  hasChanges: boolean = false
  iptVariable: string = ''
  onFocus: boolean = false
  separatorKeysCodes: number[] = [ENTER, COMMA]
  variablesCtrl = new FormControl()
  filteredVariables: Observable<any[]>
  calcVariables: any = [[],[],[],['Liberação das demais KPIs'],['&&'],[]]
  ipts: Array<any> = [[],[]]
  valueSelectAward: string = 'Selecione'
  onSelectAwardTypes: boolean = false

  stepId!: string
  metricId!: string
  metric!: any
  allMetrics!: any

  @ViewChildren('variableInput') variableInput!: QueryList<ElementRef>

  constructor(
    private modalService: NgbModal,
    private route: ActivatedRoute,
    private store: Store<State>,
    private location: Location,
    private campainService: CampainService
  ) {
    this.filteredVariables = this.variablesCtrl.valueChanges.pipe(
      startWith(null),
      map((variable: string | null) => (variable ? this.__variable(variable) : this.allVariables.slice())),
    )
    this.route.params.subscribe((parameter) => { this.stepId = parameter.step, this.metricId = parameter.metric })
  }

  ngOnInit(): void {
    this.store.select(selectSteps).subscribe((data) => data.find((el: any) => {
      if(el.id == this.stepId){
        this.allMetrics = el.metrics
        this.metric = el.metrics.find((e: any) => e.id == this.metricId)
        this.allVariables = this.metric.variables
        if(this.metric.calculation.length && this.metric.awards.length){
          this.calcVariables[0] = this.metric.calculation[0]
          this.calcVariables[1] = this.metric.calculation[1]
          this.calcVariables[2] = this.metric.calculation[2]
          this.calcVariables[3] = this.metric.awards[0]
          this.calcVariables[4] = this.metric.awards[1]
          this.calcVariables[5] = this.metric.awards[2]
          this.calcVariables[0].length ? this.ipts[0].push(1) : ''
          this.calcVariables[1].length ? this.ipts[0].push(1) : ''
          this.valueSelectAward = this.calcVariables[4][1]
          this.calcVariables[5].length ? this.ipts[1].push(1) : ''
        }      
      }
    }))
  }

  toBack():void {
    this.location.back()
  }

  openModal(){
    const modalRef = this.modalService.open(CommandListComponent, { centered: true, size: 'lg' })
  }

  handleIptVariable() {
    this.allVariables.push({
      id: Date.now(),
      name: this.iptVariable,
      type: 'number'
    })
    this.iptVariable = ''

    this.serviceVariables(this.allVariables)
  }

  changeTypeVariable(val: any){
    this.allVariables.filter((el: any) => {
      if(el.id == val.id){
        el = val
      }
    })
    this.serviceVariables(this.allVariables)
  }

  deleteVariable(val:any){
    let arr = this.allVariables.filter((el: any) => el != val)
    this.serviceVariables(arr)
  }

  serviceVariables(variables: any){
    this.allMetrics.map((el: any) => {
      if(el.id == this.metricId){
        el.variables = variables
      }
    })

    this.campainService.addMetrics({
      id_etapa: this.stepId,
      kpi: this.allMetrics
    }).subscribe((res:any) => {
      if(res.status == 202){
        this.store.dispatch(loadStepsCampain())
      }
    })
  }

  handlePopIpts(ref: string){
    if((this.calcVariables[2].length == 0) && (ref == 'calculation')){
      this.ipts[0].pop()
    }else if((this.calcVariables[5] == 0) && (ref == 'awards')){
      this.ipts[1].pop()
    }
  }

  add(event: MatChipInputEvent, ref: any): void {
    const value = event.value

    if ((value || '').trim()) {
      this.calcVariables[ref].push({
        id: Date.now(),
        name: value.trim()
      })
    }

    event.chipInput!.clear()
    this.variablesCtrl.setValue(null)
  }

  remove(variable: any, ref: any): void {
    const index = this.calcVariables[ref].indexOf(variable)

    console.log(variable,ref)
    if (index >= 0) {
      this.calcVariables[ref].splice(index, 1)
    }
  }

  selected(event: MatAutocompleteSelectedEvent | any, ref: any): void {
    // console.log(this.calcVariables)
    // console.log(event.option.value,'select',ref)

    if(ref == 1){
      this.calcVariables[1].pop()
    }

    this.calcVariables[ref].push(event.option.value)
    this.variablesCtrl.setValue(null)
  }

  private __variable(value: any): any[] {
    return this.allVariables.filter((variable:any) => {
      if((variable.id === value.id) || (variable.name.includes(value))){
        return variable
      }
    })
  }

  onSubmit(){
    this.allMetrics.map((el: any) => {
      if(el.id == this.metricId){
        el.calculation = [this.calcVariables[0],this.calcVariables[1],this.calcVariables[2]],
        el.awards = [this.calcVariables[3],this.calcVariables[4],this.calcVariables[5]]
      }
    })

    this.campainService.addMetrics({
      id_etapa: this.stepId,
      kpi: this.allMetrics
    }).subscribe((res:any) => {
      if(res.status == 202){
        this.store.dispatch(loadStepsCampain())
        this.hasChanges = false
      }
    })
  }
  
}
