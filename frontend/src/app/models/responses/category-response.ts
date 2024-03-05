import {Category} from "../category";

export interface CategoryResponse {
  category: Category;
}

export interface CategoryPagedResponse {
  categories: Category[];
}
