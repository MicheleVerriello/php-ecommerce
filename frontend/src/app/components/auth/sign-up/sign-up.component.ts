import { Component } from '@angular/core';
import {AuthorizationService} from "../../../services/auth/authorization.service";

@Component({
  selector: 'app-sign-up',
  templateUrl: './sign-up.component.html',
  styleUrl: './sign-up.component.scss'
})
export class SignUpComponent {

  constructor(private authorizationService: AuthorizationService) {}
}
