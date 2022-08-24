import { Component, Input, OnInit } from '@angular/core';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { saveAs } from 'file-saver';

@Component({
  selector: 'app-modal',
  templateUrl: './modal.component.html',
  styleUrls: ['./modal.component.scss']
})
export class ModalComponent implements OnInit {

  @Input() data: any;
  separator: string = ''
  hasError!: boolean
  head: Array<any> = []
  participants: Array<any> = []
  
  constructor(public activeModal: NgbActiveModal) { }

  ngOnInit(): void {
    this.data.head.map((el: any) => this.head.push(el.nome))
  }

  export(){
    if(!this.separator){
      this.hasError = true
    }else{
      this.participants = []
      
      this.data.participants.map((el: any) => {
        this.participants.push(Object.values(el).join(this.separator))
      })

      this.participants.unshift(this.head.join(this.separator))
      let csvArr = this.participants.join('\r\n')

      let blob = new Blob([csvArr], {type: 'text/csv;charset=urf-8'})
      saveAs(blob, `relatorio${new Date().toLocaleString('pt-br')}`, {autoBom: true})
    }
  }

}
