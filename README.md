
## Tentang Dosage GYM 

Dosage GYM adalah aplikasi web yang memiliki beberapa keunggulan yang tidak dimiliki oleh kebanyakan tempat gym, di web ini memiliki fitur member :

- Simple dan Mudah untuk digunakan
- Mendapatkan program latihan dari sumber terpercaya
- Mendapatkan news / alat tambahan yang baru di tempat GYM 

## Teknologi Yang Digunakan 

- Laravel
- Blade
- CSS
- JavaScript

installation
Prerequisites
PHP >= 8.2
Composer
Node.js & NPM
MySQL/PostgreSQL
Git
Step-by-Step Installation
Clone the Repository

git clone https://github.com/your-username/foodtracker.git
cd foodtracker
Install PHP Dependencies

composer install
Install Node Dependencies

npm install
Environment Configuration

cp .env.example .env
php artisan key:generate
Database Configuration

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=your_username
DB_PASSWORD=your_password
Database Setup

# Create database first, then run:
php artisan migrate:fresh --seed
Storage Setup

php artisan storage:link
Asset Compilation

npm run dev
# or for production:
npm run build
Start Development Server

php artisan serve
Visit http://127.0.0.1:8000 to access the application.





