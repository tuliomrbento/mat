import { Component, OnInit, TemplateRef } from '@angular/core';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { Store } from '@ngrx/store';
import { State } from 'src/app/store';
import { FilterComponent } from './filter/filter.component';
import { ModalComponent } from './modal/modal.component';
import { 
  selectHasParticipants, 
  selectStatus, 
  selectProfiles, 
  selectHasFilters, 
  selectAllParticipants, 
  selectHeadParticipants, 
  selectQtds 
} from 'src/app/store/selectors/participants.selectors'

import { handlePercentMask, formatCnpj, formatCpf, formatPhone } from 'src/app/shared/helpers/hooks';

@Component({
  selector: 'app-participants',
  templateUrl: './participants.component.html',
  styleUrls: ['./participants.component.scss']
})
export class ParticipantsComponent implements OnInit {

  hasParticipantsBase!: boolean
  participants: Array<any> = []
  qtds!: any
  headParticipants: Array<any> = []
  headerStatus: Array<any> = []
  profiles: Array<any> = []
  showFilter: boolean = false
  hasFilter!: boolean
  handlePercentMask = handlePercentMask
  formatCnpj = formatCnpj
  formatCpf = formatCpf
  formatPhone = formatPhone

  constructor(private modalService: NgbModal, private store: Store<State>) {} 
  
  ngOnInit(): void {
    this.store.select(selectHeadParticipants).subscribe((data) => this.headParticipants = data)
    this.store.select(selectHasParticipants).subscribe((data) => this.hasParticipantsBase = data)
    this.store.select(selectAllParticipants).subscribe((data) => this.participants = data)
    this.store.select(selectQtds).subscribe((data) => this.qtds = data)
    this.store.select(selectStatus).subscribe((data) => this.headerStatus = data)
    this.store.select(selectProfiles).subscribe((data) => this.profiles = data)
    this.store.select(selectHasFilters).subscribe((data) => this.hasFilter = data)
  }

  openModal(): void {
    const modalRef = this.modalService.open(ModalComponent, { centered: true })
    modalRef.componentInstance.data = {
      status: this.headerStatus,
      head: this.headParticipants,
      participants: this.participants
    }
  }

  openFilter(){
    const modalRed = this.modalService.open(FilterComponent,{ windowClass: 'rightnav', size: 'lg'})
  }

  handleStatusItem(id_status: number, ref: string) {
    let res = this.headerStatus.find((el) => el.id === id_status)
    return res.color
  }

  handleProfileItem(id_profile: number){
    let res = this.profiles.find((el) => el.id === id_profile)
    return res?.nome
  }

  handleCounters(id_status: number): any{
    let count = 0
    
    this.participants.filter((el): any => {
      if(el.id_status === id_status){
        count += 1
      }
    })
    return count
  }

}
