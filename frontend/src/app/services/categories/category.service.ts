import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs";
import {ItemResponse} from "../../models/responses/item-response";
import {Category} from "../../models/auth/category";
import {CategoryPagedResponse, CategoryResponse} from "../../models/responses/category-response";

@Injectable({
  providedIn: 'root'
})
export class CategoryService {

  private apiUrl: string = 'http://localhost:8000/api/categories';
  constructor(private http: HttpClient) { }

  getAllCategories(): Observable<CategoryPagedResponse> {
    return this.http.get<CategoryPagedResponse>(this.apiUrl);
  }

  insertCategory(category: Category): Observable<CategoryResponse> {
    return this.http.post<CategoryResponse>(this.apiUrl, category);
  }

  searchCategories(searchValue: string): Observable<CategoryPagedResponse> {
    return this.http.get<CategoryPagedResponse>(`${this.apiUrl}/?searchValue=${searchValue}`);
  }

  deleteCategory(id: number): Observable<any> {
    return this.http.delete(`${this.apiUrl}/${id}`);
  }

  getItemById(id: number): Observable<ItemResponse> {
    return this.http.get<ItemResponse>(`${this.apiUrl}/${id}`);
  }
}
