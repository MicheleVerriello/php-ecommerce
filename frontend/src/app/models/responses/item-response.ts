import {Item} from "../auth/item";

export interface ItemResponse {
  item: Item;
}

export interface ItemsResponse {
  items: Item[];
}

export interface InsertResponse {
  item: number;
}
