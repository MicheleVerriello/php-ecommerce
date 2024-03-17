import {Component, OnInit} from '@angular/core';
import {Router} from "@angular/router";
import {
  faCartShopping,
  faClose,
  faDoorClosed,
  faEye,
  faEyeSlash,
  faRightFromBracket
} from "@fortawesome/free-solid-svg-icons";

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrl: './navbar.component.scss'
})
export class NavbarComponent implements OnInit {

  readonly cartShoppingIcon = faCartShopping;
  readonly logoutIcon = faRightFromBracket;


  constructor(private router: Router) {}

  ngOnInit() {}

  logout() {
    window.localStorage.clear();
    this.router.navigate(['/auth/login']);
  }

  isAdmin(): boolean {

    let isAdmin = window.localStorage.getItem('isAdmin');

    if(isAdmin != null) {
      console.log(isAdmin === 'true')
      return isAdmin === 'true';
    } else {
      return false;
    }
  }

  goToCart() {
    this.router.navigate(['/user/cart']);
  }
}
