import { Component } from '@angular/core';
import {Item} from "../../../models/item";
import {ItemService} from "../../../services/items/item.service";
import {CategoryService} from "../../../services/categories/category.service";
import {ActivatedRoute, Router} from "@angular/router";
import {faCartShopping, faCircleInfo, faClose} from "@fortawesome/free-solid-svg-icons";
import {CartService} from "../../../services/cart/cart.service";
import {CartItem} from "../../../models/cart";
import {Category} from "../../../models/category";

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
  cartItem: CartItem = {fkiditem: 0, fkiduser: 0, id: 0, quantity: 1}
  userId: number = 0;
  isQueryParamPresent: boolean = false;
  categoryFilterId: number | string | null = null;
  categories: Category[] = [];
  protected readonly faClose = faClose;

  constructor(private itemService: ItemService,
              private categoryService: CategoryService,
              private cartService: CartService,
              private router: Router,
              private route: ActivatedRoute) {}

  ngOnInit(): void {
    this.isQueryParamPresent = this.route.snapshot.queryParamMap.has('isOffer');
    this.searchItems();
    this.userId = Number(window.localStorage.getItem('id'));
    this.cartItem.fkiduser = this.userId;
    this.getAllCategories();
  }

  searchItems(): void {
    this.itemService.searchItems(this.searchValue, this.isQueryParamPresent, this.categoryFilterId).subscribe(response => {
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

  addToCart(id: number) {
    this.cartItem.fkiditem = id;
    this.cartService.addItemIntoCart(this.cartItem).subscribe();
  }

  getAllCategories() {
    this.categoryService.getAllCategories().subscribe(response => {
      this.categories = response.categories;
    });
  }
}
