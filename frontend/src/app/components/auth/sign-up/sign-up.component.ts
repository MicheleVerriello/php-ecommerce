import { Component } from '@angular/core';
import {AuthorizationService} from "../../../services/auth/authorization.service";
import {User} from "../../../models/auth";
import {faEye, faEyeSlash} from "@fortawesome/free-solid-svg-icons";
import {Router} from "@angular/router";

@Component({
  selector: 'app-sign-up',
  templateUrl: './sign-up.component.html',
  styleUrl: './sign-up.component.scss'
})
export class SignUpComponent {

  repeatedPassword: string = '';
  showError = false; // shows an error if user can't log in
  showPasswordError = false;
  user: User;
  hidePassword = true;
  hideRepeatedPassword = true;

  constructor(private authorizationService: AuthorizationService, private router: Router) {
    this.user = {
      id: 0,
      name: "",
      surname: "",
      email: "",
      password: "",
      address: "",
      phone: "",
      isAdmin: false
    }
  }

  signup() {

    this.showError = false;

    this.authorizationService.signUp(this.user).subscribe(response => {
        window.localStorage.setItem('id', response.user.id ? response.user.id.toString() : '0');
        if (response.user.isAdmin) { // go to admin panel
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
