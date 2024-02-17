import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { LoginComponent } from './components/auth/login/login.component';
import { SignUpComponent } from './components/auth/sign-up/sign-up.component';
import {FormsModule} from "@angular/forms";
import { HttpClientModule} from "@angular/common/http";
import {AuthorizationService} from "./services/auth/authorization.service";
import { ProfileComponent } from './components/admin/profile/profile.component';
import { ItemsComponent } from './components/admin/items/items.component';
import { HomeComponent } from './components/user/home/home.component';
import {fas} from '@fortawesome/free-solid-svg-icons';
import {faEye, faEyeSlash} from "@fortawesome/free-solid-svg-icons";
import {library} from "@fortawesome/fontawesome-svg-core";
import {FontAwesomeModule} from "@fortawesome/angular-fontawesome";

// Add icons to the library (you can add more icons as needed)
library.add(fas, faEye, faEyeSlash);

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    SignUpComponent,
    ProfileComponent,
    ItemsComponent,
    HomeComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    HttpClientModule,
    FontAwesomeModule
  ],
  providers: [
    AuthorizationService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }