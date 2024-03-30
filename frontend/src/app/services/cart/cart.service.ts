import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs";
import {CartItem} from "../../models/cart";
import {CartResponse} from "../../models/responses/cart-response";

@Injectable({
  providedIn: 'root'
})
export class CartService {

  private apiUrl = 'http://localhost:8000/api/carts';
  constructor(private http: HttpClient) { }

  addItemIntoCart(cartItem: CartItem): Observable<any> {
    return this.http.post<any>(`${this.apiUrl}/items`, cartItem);
  }

  getCartByUserId(userId: number | string): Observable<CartResponse> {
    return this.http.get<CartResponse>(`${this.apiUrl}/${userId}`);
  }

  removeItemFromCart(id: number): Observable<any> {
    return this.http.delete(`${this.apiUrl}/items/${id}`);
  }

  updateCartItemQuantity(cartItem: CartItem): Observable<any> {
    return this.http.put<any>(`${this.apiUrl}/items/${cartItem.id}`, cartItem);
  }

  clearCart(idUser: number): Observable<any> {
    return this.http.delete<any>(`${this.apiUrl}/${idUser}`);
  }
}
