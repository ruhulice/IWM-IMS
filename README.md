Project Discription in GIT IWM Integrated Management System (IWM-IMS)
A web-based Laravel application using PostgreSQL.

Requirements
PHP <= 8.1
Laravel Framework=8.83.27
PostgreSQL >= 14
Composer
Node.js & NPM (optional)
Installation
Clone the repo: git clone http://apps.iwmbd.com/ruh/iwm-ims.git
Install dependencies: composer install
Copy .env.example to .env and update PostgreSQL credentials.
Generate app key: php artisan key:generate
Run migrations: php artisan migrate
Seed the database (optional): php artisan db:seed
Serve the app: php artisan serve
PostgreSQL Configuration
Set up PostgreSQL in your .env file: