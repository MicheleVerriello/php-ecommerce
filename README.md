# php-ecommerce
## Stack
- PHP & Laravel
- Typescript & Angular
- PostgreSQL

## Getting Started
1. Download Visual Studio Code
2. Download PHP 8.3.1 (if on MacOS use homebrew)
3. Download Composer (package manger for PHP) `https://getcomposer.org/download/` (place in the project root folder and type the 4 commands, then install globally) `2.6.6`

## System Design

### Database



### Endpoints

#### Authorization
- `POST /api/authorize/login {email, password, userType}` login.
- `POST /api/authorize/signup {name, surname, email, password, address, userType}` register a user.

#### Items
- `POST /api/items {name, description, price, photo}` insert item to sell
- `PUT /api/items/{id} {name, description, price, photo}` update item
- `DELETE /api/items/{id}` delete item
- `GET /api/items?name=` search for items by name
- `GET /api/items/{id}` get item details

#### Cart
- `POST /api/cart/ {idUser}` create the cart
- `POST /api/cart/{id}/items {idItem, quantity}` add item to cart
- `PUT /api/cart/items/{idCartItem} {quantity}` update cart item quantity
- `DELETE /api/cart/items/{idCartItem}` delete cart item
- `GET /api/cart/{idUser}` get cart

#### Orders
- `POST /api/orders {idUser, idCart, totalPrice}` place an order
- `GET /api/orders/{idUser}` get orders by user id
- `GET /api/orders/{id}` get order details
- `DELETE /api/orders/{id}` delete order


### UI

