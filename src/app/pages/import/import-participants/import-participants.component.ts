  import { Component, OnInit } from '@angular/core';
  import { Store } from '@ngrx/store';
  import { DownloadService } from 'src/app/services/files/download.service'
  import { SendFileService } from 'src/app/services/files/send-file.service';
  import { State } from 'src/app/store';
  import { selectAllCampains, selectImportsParticipants } from 'src/app/store/selectors/campain.selectors';
  import { maskDate } from 'src/app/shared/helpers/hooks';
  import * as saveAs from 'file-saver';
  import Swal from 'sweetalert2';
import { selectUser } from 'src/app/store/selectors/shared.selectors';
import { loadSharedProperties } from 'src/app/store/actions/shared.actions';

  @Component({
    selector: 'app-import-participants',
    templateUrl: './import-participants.component.html',
    styleUrls: ['./import-participants.component.scss']
  })
  export class ImportParticipantsComponent implements OnInit {

    loader = ''
    fileName: string = ''
    textCsv: string = ''
    imports?: any
    maskDate = maskDate
    campain!: any
    user!: any
    lastFilename!: string
    lastDateFile!: string

    constructor(
      private downloadService: DownloadService,
      private sendFileService: SendFileService,
      private store: Store<State>
    ) {
    }
    
    async ngOnInit(): Promise<void> {
      this.store.select(selectImportsParticipants).subscribe((data) => this.imports = data.filter((el:any) => el.status == 'P' ))
      this.store.select(selectAllCampains).subscribe((data) => this.campain = data)
      this.store.select(selectUser).subscribe((data) => this.user = data)
      setTimeout(() => {
        this.lastFilename = this.imports.reverse().slice(-1)[0]?.arquivo_nome
        this.lastDateFile = this.imports.reverse().slice(-1)[0]?.criado_em
      }, 400);
    }

    changeListener(files: any){
      this.fileName = files.target.files[0].name
      let reader = new FileReader();
      reader.readAsDataURL(files.target.files[0]);
      reader.onload = (e) => {
        this.textCsv = reader.result as string;
        //this.textCsv = f.split(',')[1]
      }
    }

    sendFile(){
      this.sendFileService.sendCsv({
        arquivo: {
          'base64': this.textCsv,
          'nome': this.fileName
        },
        date: new Date().toISOString(),
        id_campanha: this.campain.id,
        id_empresa: this.user.empresa
      }).subscribe((res: any) => {
        Swal.fire({
          icon: res.body.error ? 'error' : 'success',
          title: res.body.error ? 'Tivemos um problema!' : 'Ok, estamos quase lá!',
          text: res.body.message
        }).then(() => {
          if(!res.body.error){
            this.sendFileService.cron().subscribe((res: any) => {
              Swal.fire({
                icon: 'info',
                title: 'Carregando...',
                text: 'Isso pode levar algum tempo.'
              }).then(() => {
                if(res.success){
                  this.store.dispatch(loadSharedProperties())
                  Swal.fire({
                    icon: 'success',
                    title: 'Tudo certo!',
                    text: 'Importação completa.'
                  })
                }
              })
            })
          }
        })
      })
    }

    downloader(){
      this.downloadService.getModel(this.campain.id).subscribe((res: any) => {
        let data = res.item.join(';')
        data += '\uFEFF'
        let blob = new Blob([data], {type: 'text/csv;charset=UTF-8'})
        saveAs(blob, `padrao${new Date().toLocaleString('pt-br')}`, {autoBom: true})
      })
    }

    // downloader(url: string, filename: string): void {
    //   this.downloadService.downloader(url).subscribe(
    //     async (blob: any) => {
    //       const a = document.createElement('a')
    //       const objectUrl = URL.createObjectURL(blob)
    //       a.href = objectUrl
    //       a.download = filename
    //       a.click()
    //       URL.revokeObjectURL(objectUrl)
    //       this.loader = ''
    //     }
    //   )
    // }

  }
