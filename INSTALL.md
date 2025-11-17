# BPSU Bulletin — Installation Guide

This document describes how to set up and run the BPSU-Bulletin project locally.

## Requirements ✅

- PHP 8.0 or later (with extensions: PDO_mysql, cURL, OpenSSL, mbstring, JSON, fileinfo)
- Composer
- MySQL / MariaDB
- Node.js and npm (for Tailwind + front-end tooling)
- Git (optional, for cloning)

Note: You can use an AMP stack such as XAMPP, WampServer, Laragon, or use Docker if you prefer.

---

## 1) Clone the repository

```pwsh
# Windows PowerShell (pwsh) commands
git clone https://github.com/WindWalker01/BPSU-Bulletin.git
cd BPSU-Bulletin
```

## 2) Install PHP dependencies

```pwsh
composer install
```

This downloads vendor libraries (Google API client, Cloudinary PHP SDK, JWT library, PHPMailer, Carbon, etc.). Read any Composer output for missing PHP extension warnings.

## 3) Install Node dependencies (Tailwind)

```pwsh
npm install
```

Optional: To build CSS once:

```pwsh
npm run build
```

If you want a hot/dev watcher while editing CSS:

```pwsh
npm run dev
```

---

## 4) Configure application settings

1. The config file is already setup on the provided project folder called "BPSU-Bulletin" so just skip that step except for the MYSQL DSN.

2. Open `config/config.php` and update the following keys:

- `database.host`, `database.port`, `database.dbname`, `database.user`, `database.password`

---

## 5) Create and seed the database

1. Create a MySQL database:

```pwsh
mysql -u root -p
# or use your DB admin tool (phpMyAdmin, MySQL Workbench)
# inside MySQL shell:
CREATE DATABASE bulletin CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
exit;
```

2. Import the SQL schema

```pwsh
mysql -u your_username -p bulletin < .\public\bulletin.sql
```

This creates all tables used by the app (users, blogs, comments, notifications, etc.).

> Tip: If you prefer a GUI, use phpMyAdmin or MySQL Workbench to import `public/bulletin.sql`.

> Important: Please make sure to change the user, password, db name, port, and host according to your MySQL local account in the config.php file.

---

## 6) Run the app

You can use the built-in PHP server for development.

From the project root:

```pwsh
# Starts a local server at http://localhost:8069
composer run-script dev
# or
php -S localhost:8069 -t public
```

Open `http://localhost:8069` in your browser.

Optional: If you use Node watcher for Tailwind, open another shell and run:

```pwsh
npm run dev
```

---

## 7) Authentication & services

- Google Login: Create OAuth credentials in Google Cloud Console and add `client_id`, `client_secret`, and matching redirect URIs in `config/config.php`.
- Cloudinary: Add cloud name, api key, and secret to `config/config.php` for image uploads.
- Email: `email_app_password` can be used for sending emails via PHPMailer—update credentials accordingly.

---

## Troubleshooting ⚠️

- "Missing PDO extension" — Ensure `php_pdo_mysql` is enabled in `php.ini`.
- 500/Blank pages — Check `error_log` or enable debug in `config/config.php` temporarily.
- Google OAuth redirect mismatch — Confirm redirect URIs in Google Console exactly match `website_url`/redirect uri.

---

## Security & production notes 🔒

- Use environment variables or secrets management in production; do not commit `config/config.php` with real credentials.
- Use HTTPS in production; update `website_url` to the real HTTPS domain.
- Secure your database and restrict access by IP where possible.
