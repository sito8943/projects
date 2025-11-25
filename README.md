<div align="center">

# Proctique

Free project discovery platform for everyone.

</div>

## Overview

Proctique is a Laravel 12 application where people can publish and discover projects. Users can browse projects by tags, view details, leave reviews (stars and comments), and report inappropriate reviews. Authenticated users can manage their own projects, reviews, and reports. Admins have moderation capabilities for tags and platform content.

## Getting Started

### Prerequisites
- PHP 8.3+
- Composer 2+
- Node.js 18+ and npm
- A database (MySQL/PostgreSQL) or SQLite

### Clone
```bash
git clone https://github.com/sito8943/proctique.git proctique
cd proctique
```

### Install & Configure

```bash
composer install
cp .env.example .env
php artisan key:generate
# Update .env with your DB credentials

# Run migrations (with demo data)
php artisan migrate --seed
```

### Run the app

*Note if you are using Laravel Herd (or something like it) you don't need to run the scripts below*

```bash
# PHP server (default: http://127.0.0.1:8000)
php artisan serve

# Optional: run everything together (server, queue, logs, Vite)
composer dev
```

## Main Functionality
- Authentication: user registration, login, email verification.
- Project browsing: list projects and view project details.
- Tags: filter/browse projects by tag; many‑to‑many relation.
- Reviews: leave star ratings and comments on projects.
- Reports: report inappropriate reviews for moderation.
- User area: manage profile, own projects, reviews, and reports.
- Admin area: manage tags and moderate platform content.

## Data Model (high level)
- Users: authors of projects, reviews, and reports.
- Projects: authored by users, tagged, reviewed by others.
- Tags: categorize projects (many‑to‑many with projects).
- Reviews: comment + star rating on projects.
- Reports: user‑submitted flags on reviews.

---

Made with Laravel 12, Vite, Tailwind, and Breeze.
