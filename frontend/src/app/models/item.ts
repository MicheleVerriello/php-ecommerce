export interface Item {
  id: number;
  name: string;
  description: string;
  quantity: number;
  price: number;
  fkidcategory: number;
  category: string;
  isoffer: boolean;
  photo: string;
}
