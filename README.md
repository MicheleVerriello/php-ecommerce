# php-ecommerce
## Stack
- PHP & Laravel
- Typescript & Angular
- PostgreSQL

## Getting Started
1. Download Visual Studio Code.
2. Download PHP 8.3.1 (if on MacOS use homebrew).
3. Download Composer (package manger for PHP) `https://getcomposer.org/download/` (place in the project root folder and type the 4 commands, then install globally) `2.6.6`.
4. Download PostgreSQL 16.
5. Download TablePlus (optional, useful to see tables and data).
6. Download PHPStorm (optional, better dev experience, can use university account and see data and tables as well).

### Download frontend
Angular CLI: 17.1.3 <br>
Node: 20.11.0 <br>
Package Manager: npm 10.4.0 <br>

## System Design

### Database Tables

#### users
```
 id (primary key) (integer)
 name (text)
 surname (text)
 email (text)
 password (text)
 address (text)
 phone (text)
 isAdmin (bool)
```

#### items
```
id (primary key) (integer)
name (text)
description (text)
price (float)
photo (blob) (idk if it's fast to add this feature)
idCategory (foreign key) (integer) (default to null)
```

#### categories
```
id (primary key) (integer)
name (text)
```

#### cartitems
```
id (primary key) (integer)
idUser (foreign key) (integer) (del cascade)
idItem (foreign key) (integer) (del cascade)
quantity (integer)
```

#### orders
```
id (primary key) (integer)
idUser (foreign key) (integer) (del cascade)
totalPrice (float)
date (timestamp)
```

#### ordersitems
```
id(primary key) (integer)
idOrder (foreign key) (integer) (del cascade)
idItem (foreign key) (integer) (del no action)
```


### Endpoints

#### Authorization
- `POST /api/authorize/login {email, password, userType}` login.
- `POST /api/authorize/signup {name, surname, email, password, address, phone, isAdmin}` register a user.

#### Items
- `POST /api/items {name, description, price, photo}` insert item to sell
- `PUT /api/items/{id} {name, description, price, photo}` update item
- `DELETE /api/items/{id}` delete item
- `GET /api/items?name=` search for items by name
- `GET /api/items/{id}` get item details

#### Cart
- `POST /api/cart/{id}/items {idItem, quantity}` add item to cart
- `PUT /api/cart/items/{idCartItem} {quantity}` update cart item quantity
- `DELETE /api/cart/items/{idCartItem}` delete cart item
- `GET /api/cart/{idUser}` get cart

#### Orders
- `POST /api/orders {idUser, idCart, totalPrice, status}` place an order
- `GET /api/orders/{idUser}` get orders by user id
- `GET /api/orders/{id}` get order details
- `DELETE /api/orders/{id}` delete order


### UI

