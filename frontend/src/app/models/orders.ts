import {CartItem} from "./cart";
import {Item} from "./item";

export interface Order {
  isOpen: boolean;
  id: number;
  fkiduser: number;
  totalPrice: number;
  creationDate: Date;
  deliveryDate: Date;
  deliveryDateString: string;
  delivered: boolean;
}
export interface OrderRequest {
  fkiduser: number;
  totalPrice: number;
  orderItems: CartItem[];
}

export interface OrderResponse {
  order: Order;
}

export interface OrdersResponse {
  orders: Order[];
}

export interface OrderItemsResponse {
  orderItems: OrderItem[];
}

export interface OrderItem {
  id: number;
  fkidorder: number;
  fkiditem: number;
  quantity: number
}

export interface VisualizableOrder {
  order: Order;
  items: Item[];
}
