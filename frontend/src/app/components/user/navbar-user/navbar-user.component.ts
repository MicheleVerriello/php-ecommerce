import { Component } from '@angular/core';
import {Router} from "@angular/router";

@Component({
  selector: 'app-navbar-user',
  templateUrl: './navbar-user.component.html',
  styleUrl: './navbar-user.component.scss'
})
export class NavbarUserComponent {

  constructor(private router: Router) {}

  logout() {
    window.localStorage.clear();
    this.router.navigate(['/auth/login']);
  }
}
