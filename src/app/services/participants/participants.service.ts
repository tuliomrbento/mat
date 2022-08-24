import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class ParticipantsService {

  url: string = environment.url
  headers = new HttpHeaders({'Authorization': 'Bearer tumax'})

  constructor(private http: HttpClient) { }

  getAll(params: any){
    return this.http.post(`${this.url}/participantes`,params.params, {headers: this.headers})
  }

}
