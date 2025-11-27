<div align="center">

# Proctique

Free project discovery platform for everyone.

</div>

## Overview

Proctique is a Laravel 12 application where people can publish and discover projects. Users can browse projects by tags, view details, and leave reviews (stars and comments). Authenticated users can manage their own projects and reviews. Admins have moderation capabilities for tags and platform content.

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

Please be a modern person, use Herd

You can registe to be a normal User

or use: User: admin, Password: admin for be the supowered user

## Main Functionality
- Authentication: user registration, login, email verification.
- Project browsing: list projects and view project details.
- Tags: filter/browse projects by tag; many‑to‑many relation.
- Reviews: leave star ratings and comments on projects.
- User area: manage profile, own projects, and reviews.
- Admin area: manage tags and moderate platform content.

## Data Model (high level)
- Users: authors of projects and reviews.
- Projects: authored by users, tagged, reviewed by others.
- Tags: categorize projects (many‑to‑many with projects).
- Reviews: comment + star rating on projects.
 

---

Made with Laravel 12, Vite, Tailwind, and Breeze.
