import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {LoginComponent} from "./components/auth/login/login.component";
import {SignUpComponent} from "./components/auth/sign-up/sign-up.component";
import {HomeComponent} from "./components/user/home/home.component";
import {ProfileComponent} from "./components/user/profile/profile.component";
import {ItemsComponent} from "./components/admin/items/items.component";

const routes: Routes = [
  {path: '', component: LoginComponent},
  {path: 'auth/login', component: LoginComponent},
  {path: 'auth/signup', component: SignUpComponent},
  {path: 'user/home/:id', component: HomeComponent},
  {path: 'user/profile/:id', component: ProfileComponent},
  {path: 'admin/items', component: ItemsComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
