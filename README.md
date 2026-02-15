# Warehouse Inventory Management System

Sistem manajemen inventori gudang berbasis web yang dibangun dengan Laravel, Blade, dan Tailwind CSS.

## 🚀 Fitur

- **Dashboard** - Overview statistik inventori dan aktivitas gudang
- **Manajemen Produk** - CRUD produk dengan kategori dan stok
- **Stock In/Out** - Pencatatan keluar masuk barang
- **Laporan** - Generate laporan inventori dan transaksi

## 🛠️ Tech Stack

- **Framework**: Laravel 10.x
- **Frontend**: Blade Templates + Tailwind CSS 3.x + Vite
- **Database**: MySQL 8.0
- **Icons**: Font Awesome

## 📋 Requirements

- PHP >= 8.1
- Composer
- Node.js >= 18.x & NPM
- MySQL >= 8.0
- Git

## 🔧 Installation

### 1. Clone Repository

```bash
git clone https://github.com/shafaadha/Inventory-System-Web.git
cd Inventory-System-Web
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install NPM dependencies
npm install
```

### 3. Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Configuration

Buat database baru di MySQL:

**Via phpMyAdmin:**
- Buka `http://localhost/phpmyadmin`
- Klik "New" untuk membuat database baru
- Nama database: `inventory_db`
- Collation: `utf8mb4_general_ci`
- Klik "Create"

**Via Command Line:**
```bash
mysql -u root -p
CREATE DATABASE inventory_db;
exit;
```

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventory_db
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Run Migrations

```bash
# Create database tables
php artisan migrate
```

### 6. Build Assets

**Development (dengan hot reload):**
```bash
npm run dev
```
Biarkan terminal ini running. Buka terminal baru untuk step berikutnya.

**Production:**
```bash
npm run build
```

### 7. Start Development Server

```bash
php artisan serve
```

Aplikasi akan berjalan di `http://127.0.0.1:8000`

**Note:** Untuk development, jalankan `npm run dev` dan `php artisan serve` secara bersamaan di 2 terminal berbeda untuk mendapatkan hot reload pada CSS/JS.
