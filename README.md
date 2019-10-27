# UberPigeon

An On-Demand Same-Day Traffic-Independent Document Delivery Service

## Requirements

-   PHP 7.2
-   Composer

# Getting Started

## Setup

### **1. Clone the repository**

```bash
cd ~
git clone https://github.com/Kent27/uberpigeon.git
cd uberpigeon
```

### **2. Set Up Env And Database**

```bash
cp .env.example .env
```

Update .env and set according to your database connection (Please create an empty database and refer to this newly created database)

### **3. Install Dependencies And Run Migration**

```bash
composer install
php artisan key:generate
php artisan migrate:refresh --seed
php artisan serve
```

### **4. Testing Out API**

-   Open your browser, or Postman.
-   Since localhost:8000 is the default protocol and domain, try this uri :
    `http://localhost:8000/api/user`
-   If it returns JSON with users data then you're good to go.

## API Documentation

To check the API Endpoints please open the `UberPigeon.postman_collection.json` file using Postman.

## Available Routes

**API**, all routes are prefixed with `/api`

-   `GET /user` to retrieve all users.
-   `GET /user/{id}` to retrieve a user by id.
-   `GET /pigeon` to retrieve all pigeons.
-   `GET /pigeon/{id}` to retrieve a pigeon by id.
-   `POST /pigeon` to create a pigeon.
-   `POST /pigeon/{id}` to update a pigeon.
-   `DELETE /pigeon/{id}` to delete a pigeon.
-   `POST /order` to create an order.
-   `POST /order/received/{id}` to process received order.
-   `GET /order` to retrieve all orders.
-   `GET /order/{id}` to retrieve an order by id.
-   `DELETE /order/{id}` to delete an order.
