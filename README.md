<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="320" alt="Laravel Logo" />
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
  <img src="https://img.shields.io/badge/PHP-8.2-blue" alt="PHP 8.2">
  <img src="https://img.shields.io/badge/Laravel-12-red" alt="Laravel 12">
  <img src="https://img.shields.io/badge/Filament-3-orange" alt="Filament 3">
</p>

---

# 🏥 Medical Booking Admin Panel

A full-featured medical clinic management system built with **Laravel 12**, **Filament v3**, and **Livewire**. Supports bilingual content (Arabic / English), doctor scheduling, service management, offers, and patient appointment booking.

---

## ✨ Features

- 🌐 **Bilingual Support** — Full Arabic & English UI via `filament-language-switcher`
- 👨‍⚕️ **Doctor Management** — Profiles, working hours, days off, and assigned services
- 📅 **Appointment Booking** — Available slots with booking limits and real-time tracking
- 🛠️ **Services** — Create and manage clinic services with multilingual content and image upload
- 🎁 **Offers & Discounts** — Promotional offers linked to services with expiry dates and discount percentages
- 👥 **Customer Requests** — View and manage patient booking requests
- 🔐 **Soft Deletes** — Safe deletion with restore support across all major resources
- 🖼️ **Image Management** — Upload, preview, and remove images directly from the edit form
- 📊 **Dashboard** — At-a-glance stats and available appointment calendar

---

## 🗂️ Project Structure

```
app/
├── Filament/
│   └── Resources/
│       ├── AvailableSlots/         # Slot management (days, times, booking limits)
│       ├── Doctors/                # Doctor profiles and scheduling
│       ├── Offers/                 # Promotional offers with service assignment
│       ├── Services/               # Clinic services with doctor/offer assignment
│       └── Customers/              # Patient booking requests
├── Models/
│   ├── Doctor.php
│   ├── Service.php
│   ├── Offer.php
│   ├── AvailableSlot.php
│   └── Customer.php
resources/
└── views/
    └── filament/
        └── components/
            ├── services/
            │   └── photo-preview.blade.php
            └── offers/
                └── photo-preview.blade.php
lang/
└── vendor/
    └── filament-language-switcher/
        ├── en/
        │   ├── services.php
        │   ├── offers.php
        │   └── availableSlot.php
        └── ar/
            ├── services.php
            ├── offers.php
            └── availableSlot.php
```

---

## 🚀 Installation

### Requirements

| Requirement | Version |
|-------------|---------|
| PHP         | ^8.2    |
| Laravel     | ^12.0   |
| Filament    | ^3.0    |
| MySQL       | ^8.0    |

### Steps

**1. Clone the repository**
```bash
git clone https://github.com/your-username/your-repo.git
cd your-repo
```

**2. Install dependencies**
```bash
composer install
npm install && npm run build
```

**3. Configure environment**
```bash
cp .env.example .env
php artisan key:generate
```

**4. Set up your database in `.env`**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

**5. Run migrations**
```bash
php artisan migrate
```

**6. Link storage**
```bash
php artisan storage:link
```

**7. Create admin user**
```bash
php artisan make:filament-user
```

**8. Start the server**
```bash
php artisan serve
```

Visit `http://127.0.0.1:8000/admin`

---

## 🗃️ Database Schema

### Key Tables

| Table | Description |
|-------|-------------|
| `doctors` | Doctor profiles with multilingual name/bio |
| `services` | Clinic services with multilingual title/description |
| `offers` | Promotional offers with discount and expiry |
| `available_slots` | Booking slots with time, type, and limits |
| `customers` | Patient booking requests |
| `doctor_service` | Pivot — doctors ↔ services |
| `offer_service` | Pivot — offers ↔ services |

---

## 🌐 Multilingual Content

All user-facing content (titles, descriptions) is stored as **JSON** in the database and rendered based on the active locale.

```php
// Example: accessing localized title
$locale = app()->getLocale(); // 'en' or 'ar'
$title = $service->title[$locale] ?? $service->title['en'];
```

Supported locales: **English (`en`)** and **Arabic (`ar`)**

---

## 📦 Key Packages

| Package | Purpose |
|---------|---------|
| `filament/filament` | Admin panel framework |
| `filament-language-switcher` | AR/EN language switching in admin |
| `laravel/sanctum` | API authentication |

---

## 🖼️ Image Uploads

Images are stored on the **public disk** under organized directories:

```
storage/app/public/
├── services/     # Service images
├── offers/       # Offer images
└── doctors/      # Doctor profile photos
```

The edit forms feature a custom image preview component with:
- Live preview of the current saved image
- One-click remove (deletes from storage + database)
- FileUpload reappears automatically after removal

---

## 🔧 Useful Commands

```bash
# Clear all caches
php artisan optimize:clear

# Cache Filament components
php artisan filament:cache-components

# Run migrations fresh with seeders
php artisan migrate:fresh --seed
```

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
