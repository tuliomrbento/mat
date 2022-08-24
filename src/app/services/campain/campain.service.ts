import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class CampainService {

  url: string = environment.url
  headers = new HttpHeaders({'Authorization': 'Bearer tumax'})

  constructor(private http: HttpClient) { }

  getAllSteps(id: any){
    return this.http.get(`${this.url}/etapas?id_campanha=${id}`, { headers: this.headers })
  }

  deleteStep(id: any){
    return this.http.delete(`${this.url}/etapas?id=${id}`, { headers: this.headers })
  }

  addStepCampain(data: any) {
    return this.http.post(`${this.url}/etapas`, data, { headers: this.headers })
  }

  addMetrics(data: any) {
    return this.http.put(`${this.url}/metricas`, data, { headers: this.headers })
  }

}
