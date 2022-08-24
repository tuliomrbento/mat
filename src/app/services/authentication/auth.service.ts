import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable, of, throwError } from 'rxjs';
import { switchMap } from 'rxjs/operators';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  url: string = environment.url
  headers = new HttpHeaders({'Authorization': 'Bearer tumax'})

  constructor(private http: HttpClient) { }
  
  login(usuario: string, senha: string): Observable<any>{
    
    return this.http.post(
      `${this.url}/v1/oauth`,
      { usuario: usuario, senha: senha }, 
      { headers: this.headers, observe: 'response' }
    ).pipe(
      switchMap((data: any) => {
        if(!data.body.error){
          return of(data)
        }else {
          return throwError(data.body.message)
        }
        
      })
    )
  }
}
