import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class BaseConfigService {

  url: string = environment.url
  headers = new HttpHeaders({'Authorization': 'Bearer tumax'})

  constructor(private http: HttpClient) { }

  getProperties(empresa: number) {
    return this.http.get(`${this.url}/campanhas?empresa=${empresa}`, { headers: this.headers })
  }

}
