export interface User {
  id: number;
  name: string | undefined;
  surname: string | undefined;
  email: string | undefined;
  password: string | undefined;
  address: string | undefined;
  phone: string | undefined;
  isAdmin: boolean | undefined;
}

export interface LoginRequest {
  email: string;
  password: string;
}

export interface ChangePasswordRequest {
  previousPassword: string;
  newPassword: string;
}
