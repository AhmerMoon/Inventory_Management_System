<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Inventory Management System

A comprehensive Laravel-based web application for managing products, customers, billing, and inventory with role-based access control.

![Laravel](https://img.shields.io/badge/Laravel-10.x-red.svg)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.x-purple.svg)
![PHP](https://img.shields.io/badge/PHP-8.2-blue.svg)
![MySQL](https://img.shields.io/badge/MySQL-8.x-orange.svg)

## Features

### 🔐 Authentication & Authorization
- User registration and login system
- Role-based access control (Admin/Customer)
- Secure password hashing
- Protected routes based on user roles

### 📦 Product Management
- Complete CRUD operations for products
- Real-time stock tracking
- Search functionality
- Card-based product display
- Stock level validation

### 👥 Customer Management
- Customer profile management
- User-customer relationship mapping
- Admin-only customer management
- Secure registration with password requirements

### 💰 Billing System
- Bill creation with multiple items
- Automatic total calculation
- Payment status tracking (Paid/Pending)
- Bill history and viewing
- One-click payment marking

### 🛒 Shopping Cart
- Add/remove products from cart
- Quantity adjustment
- Real-time cart counter
- Checkout to generate bills
- Empty cart state handling

### 🎨 User Experience
- Responsive design for all devices
- Consistent UI/UX across all pages
- Intuitive navigation
- Visual feedback for actions
- Form validation and error handling

## Technology Stack

- **Backend Framework:** Laravel 10
- **Frontend:** Bootstrap 5, Blade Templates
- **Database:** MySQL
- **Authentication:** Laravel Auth
- **Icons:** Font Awesome
- **Date Handling:** Carbon

## Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- MySQL 8.0 or higher
- Node.js and NPM (for frontend assets)

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/inventory-management-system.git
   cd inventory-management-system
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install frontend dependencies**
   ```bash
   npm install
   npm run build
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database**
   - Create a MySQL database
   - Update `.env` file with database credentials:
     ```
     DB_DATABASE=your_database_name
     DB_USERNAME=your_username
     DB_PASSWORD=your_password
     ```

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed the database (optional)**
   ```bash
   php artisan db:seed
   ```

8. **Start the development server**
   ```bash
   php artisan serve
   ```

9. **Access the application**
   Open your browser and navigate to `http://localhost:8000`

## Usage

### Admin Account
- Manage all products (add, edit, delete)
- View and manage all customers
- Create bills for any customer
- View all bills in the system

### Customer Account
- Browse available products
- Add products to cart
- View and manage shopping cart
- Checkout to generate bills
- View personal bill history

### Default Accounts
After seeding, you'll have:
- **Admin:** admin@example.com / password
- **Customer:** customer@example.com / password

## Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   ├── BillController.php
│   │   ├── CartController.php
│   │   ├── CustomerController.php
│   │   ├── HomeController.php
│   │   └── ProductController.php
│   └── Middleware/
├── Models/
│   ├── Bill.php
│   ├── BillItem.php
│   ├── Cart.php
│   ├── Customer.php
│   ├── Product.php
│   └── User.php
database/
├── migrations/
│   ├── create_users_table.php
│   ├── create_products_table.php
│   ├── create_customers_table.php
│   ├── create_bills_table.php
│   ├── create_bill_items_table.php
│   └── create_carts_table.php
resources/
├── views/
│   ├── layouts/
│   │   └── app.blade.php
│   ├── auth/
│   │   ├── login.blade.php
│   │   └── register.blade.php
│   ├── bills/
│   │   ├── index.blade.php
│   │   ├── create.blade.php
│   │   └── show.blade.php
│   ├── cart/
│   │   └── index.blade.php
│   ├── customers/
│   │   ├── index.blade.php
│   │   ├── create.blade.php
│   │   ├── edit.blade.php
│   │   └── show.blade.php
│   ├── products/
│   │   ├── index.blade.php
│   │   ├── create.blade.php
│   │   ├── edit.blade.php
│   │   └── show.blade.php
│   └── home.blade.php
routes/
└── web.php
```

## API Endpoints

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| GET | / | Home page | No |
| GET | /login | Login form | No |
| POST | /login | Authenticate user | No |
| GET | /register | Registration form | No |
| POST | /register | Register new user | No |
| POST | /logout | Logout user | Yes |
| GET | /products | List products | No |
| POST | /products | Create product | Admin |
| GET | /products/{id} | Show product | No |
| PUT | /products/{id} | Update product | Admin |
| DELETE | /products/{id} | Delete product | Admin |
| GET | /customers | List customers | Admin |
| POST | /customers | Create customer | Admin |
| GET | /customers/{id} | Show customer | Admin |
| PUT | /customers/{id} | Update customer | Admin |
| DELETE | /customers/{id} | Delete customer | Admin |
| GET | /bills | List bills | Yes |
| POST | /bills | Create bill | Yes |
| GET | /bills/{id} | Show bill | Yes |
| POST | /bills/{id}/pay | Mark bill as paid | Yes |
| GET | /cart | Show cart | Customer |
| POST | /cart/checkout | Checkout cart | Customer |
| DELETE | /cart/{id} | Remove from cart | Customer |

## Contributing

1. Fork the project
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.

## Acknowledgments

- Laravel community for excellent documentation
- Bootstrap for the responsive frontend framework
- Font Awesome for the icon library

## Support

If you have any questions or issues, please create an issue in the GitHub repository or contact the development team.

---

**Note:** This is a demo application for educational purposes. Always implement proper security measures for production applications.

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
