import { Component, OnInit } from '@angular/core';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { Store } from '@ngrx/store';
import { State } from 'src/app/store';
import { selectHasFilters, selectProfiles, selectAllParticipants } from 'src/app/store/selectors/participants.selectors';
import * as fromParticipantsActions from 'src/app/store/actions/participants.actions'
import { NgForm } from '@angular/forms';

@Component({
  selector: 'app-filter',
  templateUrl: './filter.component.html',
  styleUrls: ['./filter.component.scss']
})
export class FilterComponent implements OnInit {

  allParticipants: Array<any> = []
  filteredParticipants: Array<any> = []
  localParticipants!: Array<any>
  hasFilter!: boolean
  profiles!: Array<any>
  regions: Array<any> = []
  subRegions: Array<any> = []
  segments: Array<any> = []
  attendants: Array<any> = []
  valuesFilters: any = {
    statusConfirmed: false,
    statusToConfirm: false,
    statusInactive: false,
    statusPending: false,
    name: '',
    email: '',
    phone: '',
    cpf: '',
    cnpj: '',
    region: '',
    subregion: '',
    segment: '',
    attendedBy: '',
    profile: ''
  }

  constructor(public activeModal: NgbActiveModal, private store: Store<State>) { }

  ngOnInit(): void {
    this.store.select(selectHasFilters).subscribe((data) => this.hasFilter = data)
    this.store.select(selectProfiles).subscribe((data) => this.profiles = data)
    this.store.select(selectAllParticipants).subscribe((data) => this.allParticipants = data)
    this.handleOptionsValues()
  }

  handleOptionsValues(){
    this.localParticipants = this.allParticipants
    this.localParticipants.filter((el,i) => {
      if(el.segment){
        this.segments.push(el.segment)
      }
      if(el.region){
        this.regions.push(el.region)
      }
      if(el.subregion){
        this.subRegions.push(el.subregion)
      }
      if(el.attendedby){
        this.attendants.push(el.attendedby)
      }
    })
    this.regions = [...new Set(this.regions)]
    this.subRegions = [...new Set(this.subRegions)]
    this.attendants = [...new Set(this.attendants)]
    this.segments = [...new Set(this.segments)]
  }

  clear(){
    this.store.dispatch(fromParticipantsActions.loadParticipants())
    this.store.dispatch(fromParticipantsActions.toggleFilters({value: false}))
    this.activeModal.dismiss()    
  }

  toggleStateFilter(){
    this.store.dispatch(fromParticipantsActions.toggleFilters({value: true}))
    this.activeModal.dismiss()    
  }

  filterByStatus(){
    this.allParticipants.map((el) => {
      if(el.status == this.valuesFilters.statusConfirmed){
        this.filteredParticipants.push(el)
      }
      if(el.status == this.valuesFilters.statusToConfirm){
        this.filteredParticipants.push(el)
      }
      if(el.status == this.valuesFilters.statusInactive){
        this.filteredParticipants.push(el)
      }
      if(el.status == this.valuesFilters.statusPending){
        this.filteredParticipants.push(el)
      }
    })
  }

  filterByData(){
    let arrParticipants: any = []
    
    if(this.filteredParticipants.length){
      arrParticipants = this.filteredParticipants
    }else {
      arrParticipants = this.allParticipants
    }

    this.filteredParticipants = []
    
    arrParticipants.map((el: any) => {
      if(el.name.toLowerCase() === this.valuesFilters.name){
        this.filteredParticipants.push(el)
      }
      if(el.email.includes === this.valuesFilters.email){
        this.filteredParticipants.push(el)
      }
      if(el.phone.replace(/[ ()-]/g,'') === this.valuesFilters.phone){
        console.log(el.phone.replace(/[ ()-]/g,''), this.valuesFilters.phone)
        this.filteredParticipants.push(el)
      }
      if(el.cpf.replace(/[.-]/g,'') === this.valuesFilters.cpf){
        this.filteredParticipants.push(el)
      }
      if(el.cnpj.replace(/[./-]/g,'') === this.valuesFilters.cnpj){
        this.filteredParticipants.push(el)
      }
    })
  }

  filterByOptions(){

  }

  onSubmit(f: NgForm){
    this.filteredParticipants = []
    
    if(f.value.confirmed || f.value.toConfirm || f.value.inactive || f.value.pending){
      this.filterByStatus()
    }

    if(f.value.name || f.value.email || f.value.phone || f.value.cpf || f.value.cnpj){
      this.filterByData()
    }

    if(f.value.region || f.value.subregion || f.value.segment || f.value.attendedBy || f.value.profile){
      this.filterByOptions()
    }
    
    this.store.dispatch(fromParticipantsActions.loadParticipantsFiltered({
      participants: this.filteredParticipants
    }))
    this.toggleStateFilter()
  }

}   
