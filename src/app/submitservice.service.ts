import { Injectable } from '@angular/core';
import { HttpClient, HttpErrorResponse, HttpParams } from '@angular/common/http';

import { Observable, throwError } from 'rxjs';
import { map, catchError } from 'rxjs/operators';
import { SubmitInvoiceComponent } from './submit-invoice/submit-invoice.component';

@Injectable({
  providedIn: 'root'
})
export class SubmitserviceService {
  baseURL = 'http://localhost:4200/';
  submit: SubmitInvoiceComponent[];

  private handleError(error: HttpErrorResponse){
    console.log(error);
    return throwError('Error! somtheing went wrong');
  }

  constructor(private http: HttpClient) { }

  getAll(): Observable<SubmitInvoiceComponent[]>{
    return this.http.get(`${this.baseURL}/list`).pipe(
      map((res) => {
        this.submit = res['data'];
        return this.submit;
      }),
      catchError(this.handleError)
    )
  }
}
