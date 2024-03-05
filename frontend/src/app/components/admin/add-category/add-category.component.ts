import { Component } from '@angular/core';
import {CategoryService} from "../../../services/categories/category.service";
import {Category} from "../../../models/category";

@Component({
  selector: 'app-add-category',
  templateUrl: './add-category.component.html',
  styleUrl: './add-category.component.scss'
})
export class AddCategoryComponent {

  category: Category;
  categories: Category[] = [];
  showError = false;
  showSuccess = false;
  showSuccessDeletedCategory = false;
  selectedCategoryId: number = 0;

  constructor(private categoryService: CategoryService) {
    this.category = {
      id: 0,
      name: ""
    }
  }

  ngOnInit() {
    this.getAllCategories();
  }

  addCategory() {
    this.categoryService.insertCategory(this.category).subscribe(response => {
      this.category = {
        id: 0,
        name: ""
      };
      this.showSuccess = true;
      this.getAllCategories();
    },
error => {
      this.showError = true;
    });
  }

  getAllCategories() {
    this.categoryService.getAllCategories().subscribe(response => {
      this.categories = response.categories;
    });
  }

  deleteCategory() {
    this.categoryService.deleteCategory(this.selectedCategoryId).subscribe(response => {
      this.getAllCategories();
      this.showSuccessDeletedCategory = true;
    });
  }

  clearError() {
    this.showError = false;
    this.showSuccess = false;
  }
}
