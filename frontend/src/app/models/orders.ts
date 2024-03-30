import {CartItem} from "./cart";
import {Item} from "./item";

export interface Order {
  id: number;
  fkiduser: number;
  totalPrice: number;
  creationDate: Date;
}
export interface OrderRequest {
  fkiduser: number;
  totalPrice: number;
  orderItems: CartItem[];
}

export interface OrderResponse {
  order: Order;
}

export interface VisualizableOrders {
  order: Order;
  items: Item[];
}
