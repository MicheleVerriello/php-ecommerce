import { Component } from '@angular/core';
import {Item} from "../../../models/item";
import {ItemService} from "../../../services/items/item.service";
import {CategoryService} from "../../../services/categories/category.service";
import {Router} from "@angular/router";
import {faCartShopping, faCircleInfo} from "@fortawesome/free-solid-svg-icons";

@Component({
  selector: 'app-user-items',
  templateUrl: './user-items.component.html',
  styleUrl: './user-items.component.scss'
})
export class UserItemsComponent {

  items: Item[] = []; //initializing empty products array
  searchValue: string = ''; // empty search value
  comingSoonImage: string = 'comingsoonimage.jpeg';
  readonly cartShoppingIcon = faCartShopping;
  readonly faCircleInfo = faCircleInfo;

  constructor(private itemService: ItemService, private categoryService: CategoryService, private router: Router) {}

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

  goToItemDetails(id: number) {
    this.router.navigate([`/admin/items/${id}`]);
  }

  addToCart() {

  }
}
