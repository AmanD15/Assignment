import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import {Details} from '../details';
import {Observable} from 'rxjs';

@Injectable({
  providedIn: 'root'
})

export class HTTPService {
  constructor(private http: HttpClient) { }

  DetailsUrl = 'https://www.myladder.app/api/assignment/tech';

public getDetails() {
  return this.http.get<Details>(this.DetailsUrl);
}
public getDetailsResponse(): Observable<HttpResponse<Details>>{
  return this.http.get<Details>(this.DetailsUrl,{observe: 'response'})
}

}