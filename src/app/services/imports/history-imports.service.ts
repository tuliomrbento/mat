import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class HistoryImportsService {

  url: string = environment.url
  headers = new HttpHeaders({'Authorization': 'Bearer tumax'})

  constructor(private http: HttpClient) { }

  getImportsHistory(id_campanha: number){
    return this.http.get(
      `${this.url}/participantes_importar?id_campanha=${id_campanha}&pg=0&limit=18446744073709551615&filter[]=0`,
      { headers: this.headers }
    )
  }
}