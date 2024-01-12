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


### UI

