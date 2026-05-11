# DocNest - Doctor Discovery & Appointment Platform

DocNest is a premium web platform designed to connect patients with the right medical specialists. It features an advanced doctor discovery system, wishlist management, and a comprehensive review/rating system.

## 🚀 Key Features

- **Advanced Doctor Search**: Filter doctors by specialty, location (Division/District/Area), fee range, and experience.
- **Premium Doctor Profiles**: Detailed profiles featuring bio, education, experience, and chamber schedules.
- **User Wishlist**: Save favorite doctors for quick access.
- **Review & Rating System**: Users can rate doctors and leave feedback, moderated by administrators.
- **Modern Admin Panel**: Comprehensive management of departments, locations, doctors, and activity logs.
- **Activity Logging**: Full audit trail of all administrative actions.

## 🛠 Tech Stack

- **Framework**: Laravel 12
- **Frontend**: Tailwind CSS (Blade Components)
- **Database**: MySQL / PostgreSQL / SQLite
- **Packages**:
    - `spatie/laravel-permission` (Role & Permission Management)
    - `spatie/laravel-medialibrary` (Image/File Management)
    - `spatie/laravel-activitylog` (Audit Logs)
    - `laravel/breeze` (Authentication)

## 📋 Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js & NPM
- A local server environment (Laragon, XAMPP, or Laravel Sail)

## ⚙️ Installation & Setup

1. **Clone the Repository**
   ```bash
   git clone https://github.com/your-username/docnest.git
   cd docnest
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Configuration**
   - Copy the `.env.example` file to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Update your database credentials in the `.env` file:
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=docnest
     DB_USERNAME=root
     DB_PASSWORD=
     ```

4. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

5. **Run Migrations & Seeders**
   ```bash
   php artisan migrate --seed
   ```

6. **Build Assets**
   ```bash
   npm run build
   ```

7. **Link Storage**
   ```bash
   php artisan storage:link
   ```

8. **Start the Application**
   ```bash
   php artisan serve
   ```
   Visit `http://localhost:8000` in your browser.

## 🔐 Admin Access

After seeding the database, you can log in as the Super Admin:
- **Email**: `admin@docnest.com`
- **Password**: `password`


