import {Component, OnInit} from '@angular/core';
import {CartService} from "../../../services/cart/cart.service";
import {ItemService} from "../../../services/items/item.service";
import {CartItem, VisualizableCartItem} from "../../../models/cart";
import {faTrash} from "@fortawesome/free-solid-svg-icons";

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
  protected readonly faTrash = faTrash;

  constructor(private cartService: CartService, private itemService: ItemService) {
  }

  ngOnInit() {
    this.userId = Number(window.localStorage.getItem('id'));
    this.getAllCartItems();
  }

  getAllCartItems() {
    this.visualizableItems = [];
    this.cartService.getCartByUserId(this.userId).subscribe(response => {
      this.cartItems = response.cartItems;
      for(let cartItem of this.cartItems) {
        this.itemService.getItemById(cartItem.fkiditem).subscribe(response => {
          const item = response.item;
          const visualizableCartItem = {
            cartItem: cartItem,
            item: item
          }
          this.visualizableItems.push(visualizableCartItem);
        })
      }
    })
  }

  deleteItemFromCart(id: number) {
    this.cartService.removeItemFromCart(id).subscribe(() => {
      this.getAllCartItems();
    })
  }

  updateCartItemQuantity(cartItem: CartItem) {

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
}
