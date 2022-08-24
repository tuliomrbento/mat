import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class SendFileService {

  url: string = environment.url
  headers = new HttpHeaders({'Authorization': 'Bearer tumax'})

  constructor(private http: HttpClient) { }

  sendCsv(data: any) {
    return this.http.post(`${this.url}/participantes_importar`,data,{ headers: this.headers, observe: 'response' })
  }

  cron(){
    return this.http.get(`${this.url.split('/api')[0]}/cron/importar`)
  }

}
