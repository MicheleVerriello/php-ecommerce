import { Component } from '@angular/core';
import {ItemService} from "../../../services/items/item.service";
import {CategoryService} from "../../../services/categories/category.service";
import {Item} from "../../../models/item";

@Component({
  selector: 'app-items',
  templateUrl: './items.component.html',
  styleUrl: './items.component.scss'
})
export class ItemsComponent {

  items: Item[] = []; //initializing empty products array
  searchValue: string = ''; // empty search value

  constructor(private itemService: ItemService, private categoryService: CategoryService) {}

  ngOnInit(): void {
    console.log('ngOnInit');
    this.getAllItems();

  }

  getAllItems(): void {
    this.itemService.getAllItems().subscribe(response => {
        this.items = response.items;
        for (let item of this.items) {
          this.categoryService.getCategoryById(item.fkidcategory).subscribe(categoryResponse => {
            item.category = categoryResponse.category.name;
          })
        }
    });
  }

  searchItems(): void {
    this.itemService.searchItems(this.searchValue).subscribe(response => {
      this.items = response.items;
      for (let item of this.items) {
        this.categoryService.getCategoryById(item.fkidcategory).subscribe(categoryResponse => {
          item.category = categoryResponse.category.name;
        })
      }
    });
  }
}
