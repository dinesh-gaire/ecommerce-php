# 🎸 Musical Instruments eCommerce Website

A comprehensive PHP-based online store for musical instrument enthusiasts.

## ✨ Key Features

- 🛒 Browse Musical Instruments Catalog
- 👤 User Authentication
- 🛍️ Shopping Cart Management
- 💳 Seamless Checkout Process
- 📋 Order History Tracking

## 🏗️ Project Structure

### Key Directories
- `partials/`: Reusable PHP components
- `styles/`: CSS stylesheets

### Main Pages
- `item_page.php`: Product details
- `cart.php`: Shopping cart
- `checkout.php`: Order processing
- `your_orders.php`: Order history

## 🔧 Technologies

- **Backend**: PHP
- **Database**: MySQL
- **Frontend**: HTML/CSS
- **Data Storage**: JSON

## 🚀 Quick Start

### Prerequisites
- Local PHP environment (XAMPP/MAMP/LAMP)
- MySQL

### Installation Steps

1. Clone the repository:
   ```bash
   git clone https://github.com/dinesh-gaire/ecommerce-php.git
   ```

2. Configure Database
   - Create MySQL database `ecom`
   - Update `partials/_dbconnect.php` with database credentials

3. Launch Application
   ```
   http://localhost/ecommerce-php
   ```

## 📦 Database Configuration

Sample database connection in `partials/_dbconnect.php`:
```php
<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "ecom";
$conn = mysqli_connect($server, $username, $password, $database);
?>
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push and submit a pull request

## 📄 License

MIT License

## 💡 How to Use

1. Browse musical instruments
2. Create an account
3. Add items to cart
4. Complete checkout
5. Track your orders
