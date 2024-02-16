interface User {
  name: string;
  surname: string;
  email: string;
  password: string;
  address: string;
  phone: string;
  isAdmin: boolean;
}

interface LoginRequest {
  email: string;
  password: string;
}
