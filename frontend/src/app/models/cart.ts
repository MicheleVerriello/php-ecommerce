import {Item} from "./item";

export interface CartItem {
  id: number;
  fkiduser: number;
  fkiditem: number;
  quantity: number | null;
}

export interface VisualizableCartItem {
  cartItem: CartItem;
  item: Item;
}
