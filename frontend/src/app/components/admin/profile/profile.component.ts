import { Component } from '@angular/core';
import {faEye, faEyeSlash} from "@fortawesome/free-solid-svg-icons";
import {AuthorizationService} from "../../../services/auth/authorization.service";
import {ChangePasswordRequest, User} from "../../../models/auth";

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrl: './profile.component.scss'
})
export class ProfileComponent {

  user: User = {id: 0, name: "", isAdmin: false, password: "", email: "", phone: "", address: "", surname: ""};
  isFormEnabled: boolean = false;
  showError: boolean = false;
  changePasswordRequest: ChangePasswordRequest = {newPassword: ""};
  hideNewPassword: boolean = false;
  showSuccessChangePassword: boolean = false;
  showSuccessUpdateProfile: boolean = false;

  //icons
  protected readonly faEye = faEye;
  protected readonly faEyeSlash = faEyeSlash;

  constructor(private authService: AuthorizationService) {
    const id = window.localStorage.getItem('id');
    this.getUser(id ? id : '0');
  }

  getUser(id: string) {
    this.authService.getUserById(id).subscribe(response => {
      this.user = response.user;
    });
  }
  updateUser() {
    this.showSuccessUpdateProfile = false;
    this.showError = false;
    this.authService.updateUserDetails(this.user).subscribe(response => {
        this.user = response.user;
        this.showSuccessUpdateProfile = true;
        this.isFormEnabled = false;
      },
      error => {
        this.showError = true;
        this.isFormEnabled = false;
        this.getUser(this.user.id.toString());
      }
    );
  }

  updatePassword() {

    this.authService.updateUserPassword(this.user.id, this.changePasswordRequest).subscribe(response =>{
      this.user = response.user;
      this.showSuccessChangePassword = true;
    });
  }
}
