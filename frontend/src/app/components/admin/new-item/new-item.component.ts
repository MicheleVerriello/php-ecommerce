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
  selectedFile: File | null = null;
  showSuccess = false;

  constructor(private itemService: ItemService, private categoryService: CategoryService) {
    this.item = {category: "", description: "", fkidcategory: 0, id: 0, name: "", price: 0, quantity: 0, isoffer: false, photo: ""};
    this.getAllCategories();
  }

  onFileSelected(event: any): void {
    this.selectedFile = event.target.files[0];
  }

  addItem() {
    this.showSuccess = false;
    const formData = new FormData();
    formData.append('name', this.item.name);
    formData.append('description', this.item.description);
    formData.append('quantity', this.item.quantity.toString());
    formData.append('price', this.item.price.toString());
    formData.append('isoffer', this.item.isoffer ? '1' : '0');
    formData.append('fkidcategory', this.item.fkidcategory.toString());
    formData.append('photo', this.selectedFile as File);

    this.itemService.insertItem(formData).subscribe(response => {
        this.item = {category: "", description: "", fkidcategory: 0, id: 0, name: "", price: 0, quantity: 0, isoffer: false, photo: ""};
        this.showSuccess = true;
    });

    this.selectedFile = null;
  }

  getAllCategories() {
    this.categoryService.getAllCategories().subscribe(response => {
      this.categories = response.categories;
    })
  }
}
