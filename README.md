# IWM Integrated Management System (IWM-IMS)

A web-based Laravel application using PostgreSQL.

## Requirements

- PHP <= 8.1
- Laravel Framework=8.83.27
- PostgreSQL >= 14
- Composer
- Node.js & NPM (optional)
- Geo server API Connection

## Installation

1. Clone the repo: `git clone http://apps.iwmbd.com/ruh/iwm-ims.git`
2. Install dependencies: `composer install`
3. Copy `.env.example` to `.env` and update PostgreSQL credentials.
4. Generate app key: `php artisan key:generate`
5. Run migrations: `php artisan migrate`
6. Seed the database (optional): `php artisan db:seed`
7. Serve the app: `php artisan serve`

## PostgreSQL Configuration

Set up PostgreSQL in your `.env` file:

## Geo Server Configuration

Set up Geo Server in your `public/js/main.js` file:
