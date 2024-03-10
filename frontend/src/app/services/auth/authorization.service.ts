import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs";
import {ChangePasswordRequest, LoginRequest, User} from "../../models/auth";
import {LoginResponse} from "../../models/responses/auth-response";

@Injectable({
  providedIn: 'root'
})
export class AuthorizationService {

  private apiUrl = 'http://localhost:8000/api/auth';
  constructor(private http: HttpClient) { }

  signUp(user: User): Observable<LoginResponse> {
    return this.http.post<LoginResponse>(`${this.apiUrl}/signup`, user);
  }

  login(loginRequest: LoginRequest): Observable<LoginResponse> {
    return this.http.post<LoginResponse>(`${this.apiUrl}/login`, loginRequest);
  }

  getUserById(id: string | number): Observable<LoginResponse> {
    return this.http.get<LoginResponse>(`${this.apiUrl}/${id}`);
  }

  updateUserDetails(user: User): Observable<LoginResponse> {
    return this.http.put<LoginResponse>(`${this.apiUrl}/${user.id}`, user);
  }

  updateUserPassword(id: number, changePasswordRequest: ChangePasswordRequest): Observable<LoginResponse> {
    return this.http.put<LoginResponse>(`${this.apiUrl}/${id}`, changePasswordRequest);
  }
}
