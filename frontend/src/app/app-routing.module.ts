import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {LoginComponent} from "./components/auth/login/login.component";
import {SignUpComponent} from "./components/auth/sign-up/sign-up.component";
import {HomeComponent} from "./components/user/home/home.component";
import {ItemsComponent} from "./components/admin/items/items.component";
import {NewItemComponent} from "./components/admin/new-item/new-item.component";
import {EditItemComponent} from "./components/admin/edit-item/edit-item.component";
import {AddCategoryComponent} from "./components/admin/add-category/add-category.component";
import {ProfileComponent} from "./components/admin/profile/profile.component";

const routes: Routes = [
  {path: '', component: LoginComponent},
  {path: 'auth/login', component: LoginComponent},
  {path: 'auth/signup', component: SignUpComponent},
  {path: 'user/home/:id', component: HomeComponent},
  {path: 'profile', component: ProfileComponent},
  {path: 'admin/items', component: ItemsComponent},
  {path: 'admin/items/new', component: NewItemComponent},
  {path: 'admin/items/edit/:id', component: EditItemComponent},
  {path: 'admin/categories/new', component: AddCategoryComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
