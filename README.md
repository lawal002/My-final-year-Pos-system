# Hospital Locator System

This project provides a simple web-based hospital locator built with **PHP**, **MySQL**, and the **Google Maps JavaScript API**. The application allows users to search for nearby hospitals, view them on a map, and an admin can manage hospital records through a basic dashboard.

## Folder Structure

```
hospital_locator/
├── public/
│   ├── index.php
│   ├── search.php
│   ├── hospital_details.php
│   └── assets/
│       ├── css/
│       └── js/
├── admin/
│   ├── login.php
│   ├── dashboard.php
│   ├── manage_hospitals.php
│   ├── add_edit_hospital.php
│   ├── delete_hospital.php
│   ├── reset_password.php
│   └── logout.php
├── includes/
│   ├── db.php
│   ├── functions.php
│   └── auth.php
├── config/
│   └── config.php
└── sql/
    └── hospital_locator_schema.sql
```

## Setup Instructions

### 1. Database

1. Create a MySQL database named `hospital_locator`.
2. Import `hospital_locator/sql/hospital_locator_schema.sql` to create the required tables.
3. Insert an admin user:
   ```sql
   INSERT INTO admins (username, hashed_password, email) VALUES ('admin', PASSWORD_HASH('password', PASSWORD_DEFAULT), 'admin@example.com');
   ```

### 2. Google Maps API Key

1. Obtain a Google Maps JavaScript API key from the [Google Cloud Console](https://console.cloud.google.com/).
2. Replace `YOUR_API_KEY` in `public/index.php` with your API key.

### 3. Localhost Setup

1. Copy the `hospital_locator` folder to your web server root (e.g. `htdocs` for XAMPP or `www` for Laragon).
2. Ensure PHP and MySQL are running.
3. Update database credentials in `config/config.php` if they differ from the defaults.
4. Navigate to `http://localhost/hospital_locator/public/` to view the locator or `http://localhost/hospital_locator/admin/login.php` for the admin panel.

### 4. File Permissions & Deployment Notes

- Ensure `config/` and `includes/` folders are not publicly accessible in production.
- For production deployments, disable `display_errors` in `config/config.php` and configure HTTPS.

This repository contains a minimal demonstration suitable for further customization.
