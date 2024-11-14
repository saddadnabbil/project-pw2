# Project Pemrograman Web 2 - Sistem Penjualan

## Project Overview

This Laravel Sistem Penjualan project is an API-based system with CRUD functionality for the following resources:

- **User**
- **Barang (Products)**
- **Customer**
- **Pemesanan (Orders)**
- **Supplier**

Additionally, there are authentication routes for login and registration using Laravel Sanctum.

The frontend will provide the following Blade views to interact with the data:

- Dashboard
- User List
- Product List (Barangs)
- Customer List
- Order List (Pemesanan)
- Supplier List
- Login Page
- Register Page

The project will also include unit tests to ensure that the logic behind each endpoint works as expected.

## Prerequisites

Before starting, ensure you have the following tools installed:

- PHP 8.2+
- Composer
- Laravel 11
- Node.js and npm for frontend development
- MySQL or SQLite for database

## Installation

### 1. Clone the Repository

Clone the project repository to your local machine:

```bash
git clone https://github.com/your-username/laravel-api-crud.git
cd laravel-api-crud 
```

### 2. Install Dependencies

Install all PHP and JavaScript dependencies:

```bash
composer install
npm install 
```

### 3. Copy .env Example

Copy the `.env.example` file to `.env`:

```bash
cp .env.example .env
```

Generate a new application key:

```bash
php artisan key:generate
```

### 4. Configure Environment Variables

Create a `.env` file and set the following environment variables:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=project_pw2
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Run Database Migrations with Seeds

Run the database migrations to create the necessary tables:

```bash
php artisan migrate:fresh --seed
```

### 6. Start the Application

Start the Laravel development server:

```bash
php artisan serve
```

## Project Structure

### 1. Controllers
- AuthController: Handles login and register functionality using Laravel Sanctum.
- UserController: Manages CRUD operations for users.
- BarangController: Manages CRUD operations for products.
- CustomerController: Manages CRUD operations for customers.
- PemesananController: Manages CRUD operations for orders.
- SupplierController: Manages CRUD operations for suppliers.

### 2. Routes
- API Routes: Defined in routes/api.php, protected by Sanctum middleware.
- Web Routes: Defined in routes/web.php, for frontend views.

<!-- todo is create unit test and create frontend -->

## Todo

- ✅ Create Backend
    - ✅ Auth
    - ✅ User
    - ✅ Barang
    - ✅ Customer
    - ✅ Order
    - ✅ Supplier
- ✅ Create Documentation Backend (Postmant)
- 🔲 Create Unit Test
- 🔲 Create Frontend


