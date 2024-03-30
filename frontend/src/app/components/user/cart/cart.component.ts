import {Component, OnInit} from '@angular/core';
import {CartService} from "../../../services/cart/cart.service";
import {ItemService} from "../../../services/items/item.service";
import {CartItem, VisualizableCartItem} from "../../../models/cart";
import {faTrash} from "@fortawesome/free-solid-svg-icons";
import {forkJoin} from "rxjs";
import {OrderRequest} from "../../../models/orders";
import {OrderService} from "../../../services/orders/order.service";

@Component({
  selector: 'app-cart',
  templateUrl: './cart.component.html',
  styleUrl: './cart.component.scss'
})
export class CartComponent implements OnInit {

  cartItems: CartItem[] = [];
  visualizableItems: VisualizableCartItem[] = [];
  userId: number = 0;
  comingSoonImage: string = 'comingsoonimage.jpeg';
  totalPrice: number = 0;
  protected readonly faTrash = faTrash;

  constructor(private cartService: CartService, private itemService: ItemService, private orderService: OrderService) {
  }

  ngOnInit() {
    this.userId = Number(window.localStorage.getItem('id'));
    this.getAllCartItems();
  }

  getAllCartItems() {
    this.visualizableItems = [];
    this.cartService.getCartByUserId(this.userId).subscribe(response => {
      this.cartItems = response.cartItems;
      const observables = this.cartItems.map(cartItem =>
        this.itemService.getItemById(cartItem.fkiditem)
      );
      forkJoin(observables).subscribe((responses: any[]) => {
        responses.forEach((response: any, index: number) => {
          const item = response.item;
          const visualizableCartItem = {
            cartItem: this.cartItems[index],
            item: item
          };
          this.visualizableItems.push(visualizableCartItem);
        });
        this.totalPrice = this.calculateTotalPrice();
      });
    });
  }

  deleteItemFromCart(id: number) {
    this.cartService.removeItemFromCart(id).subscribe(() => {
      this.getAllCartItems();
    })
  }

  createArray(endValue: number): number[] {
    return  Array.from({length: endValue}, (_, i) => i + 1); //create array of number from 1 to endValue
  }

  clearCart() {
    this.cartService.clearCart(this.userId).subscribe(() => {
      this.visualizableItems = [];
      this.cartItems = [];
    })
  }

  calculateTotalPrice(): number {
    let totalPrice = 0;

    for(let visualizableItem of this.visualizableItems) {
      totalPrice = totalPrice + (visualizableItem.cartItem.quantity * visualizableItem.item.price)
    }

    return totalPrice;
  }

  updateCartItem(cartItem: CartItem) {
    this.cartService.updateCartItemQuantity(cartItem).subscribe(() => {
      this.totalPrice = this.calculateTotalPrice();
    })
  }

  placeOrder() {
    let orderRequest: OrderRequest = {
      fkiduser: this.userId,
      totalPrice: this.totalPrice,
      orderItems: this.cartItems
    }

    this.orderService
  }
}
