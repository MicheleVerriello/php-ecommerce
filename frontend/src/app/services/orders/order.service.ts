import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {OrderItemsResponse, OrderRequest, OrderResponse, OrdersResponse} from "../../models/orders";
import {Observable} from "rxjs";

@Injectable({
  providedIn: 'root'
})
export class OrderService {

  private apiURL = 'http://localhost:8000/api/orders';

  constructor(private httpClient: HttpClient) { }

  placeOrder(orderRequest: OrderRequest): Observable<any> {
    return this.httpClient.post<Observable<any>>(this.apiURL, orderRequest);
  }

  getOrderDetailsById(id: number): Observable<OrderResponse> {
    return this.httpClient.get<OrderResponse>(`${this.apiURL}/${id}`);
  }

  getOrdersByUserId(userId: number): Observable<OrdersResponse> {
    return this.httpClient.get<OrdersResponse>(`${this.apiURL}/users/${userId}`);
  }

  getOrderItemsByOrderId(id: number): Observable<OrderItemsResponse> {
    return this.httpClient.get<OrderItemsResponse>(`${this.apiURL}/items/${id}`);
  }
}
