import { HttpClient, HttpHeaders } from '@angular/common/http'
import { Injectable } from '@angular/core'
import { Observable } from 'rxjs'
import { environment } from 'src/environments/environment'

@Injectable({
  providedIn: 'root'
})
export class DownloadService {

  url: string = environment.url
  headers = new HttpHeaders({'Authorization': 'Bearer tumax'})

  constructor(private http: HttpClient) { }

  downloader(url: string): Observable<Blob>{
    return this.http.get(url, {
      responseType: 'blob',
      reportProgress: true,
      observe: 'body'
    })
  }

  getModel(id: any){
    return this.http.get(`${this.url}/participantes_export?id=${id}`,{ headers: this.headers })
  }

}
