import {Category} from "../auth/category";

export interface CategoryResponse {
  category: Category;
}

export interface CategoryPagedResponse {
  categories: Category[];
}
