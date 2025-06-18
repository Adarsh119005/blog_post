# 📝 Laravel Blog Application

This is a simple yet powerful Blog Application built with Laravel. It allows users to create, manage, and read blog posts. The project supports authentication, CRUD operations, and follows Laravel best practices.

## 🚀 Features

- User Registration and Login
- Create, Read, Update, Delete (CRUD) blog posts
- Post categorization
- Blade templating for dynamic content rendering
- Laravel Eloquent ORM for database operations
- Middleware-based access control
- Responsive design with Bootstrap (or Tailwind if used)
- SQLite or MySQL database support

## 🛠️ Tech Stack

- **Backend:** Laravel 10+
- **Database:** SQLite (default) or MySQL
- **Frontend:** Blade, HTML5, CSS3, Bootstrap/Tailwind
- **Authentication:** Laravel Breeze / Jetstream / default auth (based on your setup)

## 🔧 Installation

### Prerequisites

- PHP >= 8.1
- Composer
- Node.js and npm (for frontend assets)
- SQLite or MySQL

### Clone the Repository

```bash
git clone https://github.com/your-username/your-laravel-blog.git
cd your-laravel-blog

 ```

 ### Install Dependencies

 ```bash
 composer install
npm install && npm run dev
```

### Setup Environment
1. Copy .env.example to .env
```bash
cp .env.example .env
```

### 2.Generate application key

```bash

php artisan key:generate
```
### Choose your database (SQLite or MySQL):

For SQLite:

.env
```bash
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```
### Create the file:

```bash

touch database/database.sqlite
```
For MySQL (if preferred):
Update .env with:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_db_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```
### Run Migrations
```bash

php artisan migrate
```
### Run the Application
```bash

php artisan serve
```
Visit http://localhost:8000 in your browser.