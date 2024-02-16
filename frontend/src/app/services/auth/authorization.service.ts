import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs";

@Injectable({
  providedIn: 'root'
})
export class AuthorizationService {

  private apiUrl = 'http://localhost:8000/api/auth';
  constructor(private http: HttpClient) { }

  signUp(user: User): Observable<User> {
    return this.http.post<User>(`${this.apiUrl}/signup`, user);
  }

  login(loginRequest: LoginRequest): Observable<User> {
    return this.http.post<User>(`${this.apiUrl}/login`, loginRequest);
  }
}
