import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {LoginComponent} from "./components/auth/login/login.component";
import {SignUpComponent} from "./components/auth/sign-up/sign-up.component";
import {ItemsComponent} from "./components/admin/items/items.component";
import {NewItemComponent} from "./components/admin/new-item/new-item.component";
import {AddCategoryComponent} from "./components/admin/add-category/add-category.component";
import {ProfileComponent} from "./components/admin/profile/profile.component";
import {ItemDetailsComponent} from "./components/admin/item-details/item-details.component";
import {OffersComponent} from "./components/user/offers/offers.component";
import {OrdersComponent} from "./components/user/orders/orders.component";
import {CartComponent} from "./components/user/cart/cart.component";
import {UserItemsComponent} from "./components/user/user-items/user-items.component";
import {ContactsComponent} from "./components/user/contacts/contacts.component";

const routes: Routes = [
  // general side
  {path: '', component: LoginComponent},
  {path: 'auth/login', component: LoginComponent},
  {path: 'auth/signup', component: SignUpComponent},
  {path: 'profile', component: ProfileComponent},
  // admin side
  {path: 'admin/items', component: ItemsComponent},
  {path: 'admin/items/new', component: NewItemComponent},
  {path: 'admin/items/:id', component: ItemDetailsComponent},
  {path: 'admin/categories/new', component: AddCategoryComponent},
  // user side
  {path: 'user/offers', component: OffersComponent},
  {path: 'user/orders', component: OrdersComponent},
  {path: 'user/cart', component: CartComponent},
  {path: 'user/items', component: UserItemsComponent},
  {path: 'user/contacts', component: ContactsComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
