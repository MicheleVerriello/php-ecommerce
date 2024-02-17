export interface User {
  id: number;
  name: string;
  surname: string;
  email: string;
  password: string | undefined;
  address: string;
  phone: string;
  isAdmin: boolean;
}

export interface LoginRequest {
  email: string;
  password: string;
}
