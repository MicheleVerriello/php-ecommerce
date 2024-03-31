import {Component, ElementRef, ViewChild} from '@angular/core';
import {CategoryService} from "../../../services/categories/category.service";
import {ItemService} from "../../../services/items/item.service";
import {ActivatedRoute, Router} from "@angular/router";
import {Item} from "../../../models/item";
import {Category} from "../../../models/category";

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
  categories: Category[] = [];
  idItem: string = "";
  @ViewChild('fileInputRef') fileInputRef!: ElementRef; //reference to the file input

  constructor(private categoryService: CategoryService,
              private itemService: ItemService,
              private route: ActivatedRoute,
              private router: Router) {
    this.item = {category: "", description: "", fkidcategory: 0, id: 0, name: "", price: 0, quantity: 0, isoffer: false, photo: ""};
  }

  ngOnInit() {
    this.route.params.subscribe(params => {
      this.idItem = params['id']; // Retrieve the id parameter
      this.getItemById(this.idItem);
    });

    //get the categories
    this.getAllCategories();
  }

  updateItem() {
    this.showSuccess = false;

    this.itemService.updateItem(this.item.id, this.item).subscribe(response => {
      this.showSuccess = true;
      this.isFormEnabled = false;
    });
  }

  updatePhoto(event: any) {

    this.selectedFile = event.target.files[0];
    const formData = new FormData();
    formData.append('photo', this.selectedFile as File);

    this.itemService.updateItemPhoto(this.item.id, formData).subscribe(response => {
      this.item = response.item;
    })

    this.selectedFile = null;
  }


  getAllCategories() {
    this.categoryService.getAllCategories().subscribe(response => {
      this.categories = response.categories;
    })
  }

  getItemById(id: string | number) {
    //get the item from the database
    this.itemService.getItemById(id).subscribe(response => {
      this.item = response.item;
    })
  }

  deletePhoto() {
    this.itemService.deleteItemPhoto(this.item.id).subscribe(response => {
      this.item = response.item;
    });

    // Reset the value of the file input
    if (this.fileInputRef && this.fileInputRef.nativeElement) {
      this.fileInputRef.nativeElement.value = '';
    }
  }

  deleteItem(id: number) {
    this.itemService.deleteItem(id).subscribe(response => {
      this.router.navigate(['/admin/items']); //refresh items once one is deleted
    })
  }

  isAdmin(): boolean {
    let isAdmin = window.localStorage.getItem('isAdmin');

    if(isAdmin != null && isAdmin === 'true') return true;

    return false;
  }
}
