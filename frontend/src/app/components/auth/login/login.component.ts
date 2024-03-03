import { Component } from '@angular/core';
import {AuthorizationService} from "../../../services/auth/authorization.service";
import {LoginRequest} from "../../../models/auth/auth";
import {faEye, faEyeSlash} from '@fortawesome/free-solid-svg-icons';
import {Router} from "@angular/router";

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrl: './login.component.scss'
})
export class LoginComponent {

  email: string = '';
  password: string = '';
  loginRequest: LoginRequest | undefined;
  showError = false; // shows an error if user can't log in
  hidePassword = true;

  constructor(private authorizationService: AuthorizationService, private router: Router) {}

  login() {

    this.showError = false;

    // initializing loginRequest
    this.loginRequest = {
      email: this.email,
      password: this.password
    }

    this.authorizationService.login(this.loginRequest).subscribe(response => {
      if(response.user.isAdmin) { // go to admin panel
        this.router.navigate(['/admin/items']);
      } else { // go to user panel
        this.router.navigate(['/user/home', response.user.id]);
      }
    },
    error => {
      this.showError = true;
    });
  }

  protected readonly faEye = faEye;
  protected readonly faEyeSlash = faEyeSlash;
}
