import { Component } from '@angular/core';
import {CategoryService} from "../../../services/categories/category.service";
import {ItemService} from "../../../services/items/item.service";
import {ActivatedRoute} from "@angular/router";
import {Item} from "../../../models/item";

@Component({
  selector: 'app-item-details',
  templateUrl: './item-details.component.html',
  styleUrl: './item-details.component.scss'
})
export class ItemDetailsComponent {

  item: Item;
  showSuccess : boolean = false;
  isFormEnabled: boolean = false;
  selectedFile: File | null = null;
  comingSoonImage: string = 'comingsoonimage.jpeg';

  constructor(private categoryService: CategoryService, private itemService: ItemService, private route: ActivatedRoute) {
    this.item = {category: "", description: "", fkidcategory: 0, id: 0, name: "", price: 0, quantity: 0, isoffer: false, photo: ""};
  }

  ngOnInit() {
    this.route.params.subscribe(params => {
      const id = params['id']; // Retrieve the id parameter
      this.itemService.getItemById(id).subscribe(response => {
        this.item = response.item;
      })
    });
  }

  updateItem() {

  }

  onFileSelected(event: any): void {
    this.selectedFile = event.target.files[0];
  }

}
