import { Component } from '@angular/core';
import {ItemService} from "../../../services/items/item.service";
import {CategoryService} from "../../../services/categories/category.service";
import {Item} from "../../../models/item";
import {Category} from "../../../models/category";
import {Router} from "@angular/router";

@Component({
  selector: 'app-new-item',
  templateUrl: './new-item.component.html',
  styleUrl: './new-item.component.scss'
})
export class NewItemComponent {

  item: Item;
  categories: Category[] = [];

  constructor(private itemService: ItemService, private categoryService: CategoryService, private router: Router) {
    this.item = {category: "", description: "", fkidcategory: 0, id: 0, name: "", price: 0, quantity: 0, isOffer: false};
    this.getAllCategories();
  }

  addItem() {

  }

  getAllCategories() {
    this.categoryService.getAllCategories().subscribe(response => {
      this.categories = response.categories;
    })
  }

  goToCategories() {
    this.router.navigate(['/admin/categories/new'])
  }
}
