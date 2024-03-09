import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {ItemResponse, ItemsResponse} from "../../models/responses/item-response";
import {Observable} from "rxjs";
import {Item} from "../../models/item";
import {CategoryPagedResponse} from "../../models/responses/category-response";

@Injectable({
  providedIn: 'root'
})
export class ItemService {

  private apiUrl = 'http://localhost:8000/api/items';
  constructor(private http: HttpClient) { }

  getAllItems(): Observable<ItemsResponse> {
    return this.http.get<ItemsResponse>(this.apiUrl);
  }

  insertItem(item: FormData): Observable<ItemResponse> {
    return this.http.post<ItemResponse>(this.apiUrl, item);
  }

  updateItem(id: number, item: Item): Observable<ItemResponse> {
    return this.http.put<ItemResponse>(`${this.apiUrl}/${id}`, item);
  }

  deleteItem(id: number): Observable<any> {
    return this.http.delete(`${this.apiUrl}/${id}`);
  }

  getItemById(id: number | string): Observable<ItemResponse> {
    return this.http.get<ItemResponse>(`${this.apiUrl}/${id}`);
  }

  searchItems(searchValue: string): Observable<ItemsResponse> {
    return this.http.get<ItemsResponse>(`${this.apiUrl}/?searchValue=${searchValue}`);
  }
}
