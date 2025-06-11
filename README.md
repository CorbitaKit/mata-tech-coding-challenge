
# 🍕 Laravel Pizza Order Management System

This is a Laravel-based application for managing pizza orders, types, and details. It supports CSV import, background processing with queues, and a Vue.js (or similar) frontend using Vite.

---

## 📦 Project Setup & Installation

### ✅ Prerequisites

Ensure the following are installed on your system:

- PHP >= 8.x
- Composer
- Node.js & npm
- MySQL (or a compatible database)
- Laravel CLI (`php artisan`)
- (Optional) WSL, Linux, macOS, or Windows Terminal

---

### 🚀 Installation Steps

1. **Navigate to the project directory:**
   ```bash
   cd project_directory
   ```

2. **Install back-end dependencies:**
   ```bash
   composer install
   ```

3. **Install front-end dependencies:**
   ```bash
   npm install
   ```

4. **Copy `.env` file:**

   - On macOS/Linux/WSL:
     ```bash
     cp .env.example .env
     ```

   - On Windows CMD:
     ```bash
     copy .env.example .env
     ```

5. **Update database credentials in `.env`:**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Add frontend API base URL:**
   ```env
   VITE_API_BASE_URL=/api/v1/
   ```

7. **Generate application key:**
   ```bash
   php artisan key:generate
   ```

8. **Run migrations:**
   ```bash
   php artisan migrate
   ```

---

## ✅ Run Automated Tests

```bash
php artisan test
```

---

## 🖥 Running the Application

1. **Compile assets and run dev server:**
   ```bash
   composer run dev
   ```

2. **Visit the application:**
   ```
   http://localhost:8000
   ```

---

## 📥 Import CSV Data

Import pizza-related CSV files into the database using Artisan commands:

```bash
php artisan import:csv storage/app/pizza_types.csv PizzaType
php artisan import:csv storage/app/pizzas.csv Pizza
php artisan import:csv storage/app/orders.csv Order
php artisan import:csv storage/app/order_details.csv OrderDetail
```

---

## 👤 Generate a Test User

```bash
php artisan generate:user yourEmail "User Name" yourPassword
```

---

## ⚠️ Important Notice

> Order and order detail data is processed asynchronously using jobs and queues. It may take a few moments before all data is fully available.

---

## 🛠️ Environment

- Laravel 11 (or compatible version)
- Vite + Node for frontend builds
- MySQL for database
- PHP queue workers for background processing

---

## 📄 License

This project is open-source and available under the [MIT License](LICENSE).
