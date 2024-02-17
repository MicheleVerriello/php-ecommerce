import { Component } from '@angular/core';
import {AuthorizationService} from "../../../services/auth/authorization.service";
import {LoginRequest} from "../../../models/auth/auth";

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

  constructor(private authorizationService: AuthorizationService) {}

  login() {

    this.showError = false;

    // initializing loginRequest
    this.loginRequest = {
      email: this.email,
      password: this.password
    }

    this.authorizationService.login(this.loginRequest).subscribe(response => {
        console.log(response)
        if(response.isAdmin) { // go to admin panel

        } else { // go to user panel

        }
    },
    error => {
      console.log("Error: " , error)
      this.showError = true;
    });
  }
}
