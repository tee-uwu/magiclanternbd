# Hostinger Deployment (magiclanternbd.com)

This project is a **Laravel 10 + Filament** PHP application. For security, keep the Laravel core **outside** `public_html`, and expose only a small `public_html` entrypoint that forwards to Laravel’s real `public/` directory.

## 1) Create the database (Hostinger)

You already have:

- **DB name**: `u508382639_magiclanternbd`
- **DB user**: `u508382639_gregor`
- **DB password**: (use the one you shared in hPanel)

## 2) Upload files

Recommended structure on Hostinger:

- `~/laravel/`  → upload the whole Laravel project here (everything in this repo)
- `~/public_html/` → contains only the web entry files (index.php, .htaccess, storage symlink)

## 3) Create `.env` on the server

Copy `.env.example` to `.env` in `~/laravel/` and set:

```env
APP_NAME=MagicLanternBD
APP_ENV=production
APP_DEBUG=false
APP_URL=https://magiclanternbd.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=u508382639_magiclanternbd
DB_USERNAME=u508382639_gregor
DB_PASSWORD=YOUR_DB_PASSWORD

META_PIXEL_ID=YOUR_PIXEL_ID
GA_MEASUREMENT_ID=G-XXXXXXXXXX
```

## 4) Install dependencies (SSH)

From `~/laravel/`:

```bash
composer install --no-dev --optimize-autoloader
php artisan key:generate
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 5) Point `public_html` to Laravel `public/`

### Option A (best): set document root to `~/laravel/public`

If Hostinger lets you change the domain “Document Root”, set it to:

- `laravel/public`

Then you do **not** need the forwarding `index.php` below.

### Option B: keep document root as `public_html` (works everywhere)

1) Copy these files from `~/laravel/public/` into `~/public_html/`:
   - `index.php`
   - `.htaccess`

2) Edit `~/public_html/index.php` and change the paths so they point to `~/laravel/`:

```php
require __DIR__ . '/../laravel/vendor/autoload.php';
$app = require_once __DIR__ . '/../laravel/bootstrap/app.php';
```

3) Ensure `storage` is accessible:
   - either run `php artisan storage:link` (creates `public/storage`)
   - or create a symlink from `public_html/storage` → `laravel/storage/app/public`

## 6) Permissions

Ensure these directories are writable by PHP:

- `laravel/storage/`
- `laravel/bootstrap/cache/`

## 7) Final checks

- Visit:
  - `https://magiclanternbd.com/`
  - `https://magiclanternbd.com/admin/login`
- If you see 500 errors: check `laravel/storage/logs/laravel.log`

