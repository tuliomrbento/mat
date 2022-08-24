import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class ImportsService {

  url: string = environment.url
  headers = new HttpHeaders({'Authorization': 'Bearer tumax'})

  constructor(private http: HttpClient) { }

  getModel(id: any){
    return this.http.get(`${this.url}empresa/campanha/participantes_exportar/${id}`,{ headers: this.headers })
  }  

}
