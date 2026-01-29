[![Laravel Forge Site Deployment Status](https://img.shields.io/endpoint?url=https%3A%2F%2Fforge.laravel.com%2Fsite-badges%2F3e08b2d7-769f-4ab7-8afc-8ab254eec848&style=plastic)](https://forge.laravel.com/sito/proctique-forge/2998212)

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

For all available environment keys, see docs/environment-keys.md.

### Run the app

Please be a modern person, use Herd

You can registe to be a normal User

or use: User: admin@admin.com, Password: admin for be the supowered user

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

## GitHub Integration

Projects may include an optional GitHub repository URL (e.g. `https://github.com/user/repo`). When provided during creation:

- The app attempts to fetch the repository README via GitHub REST API v3 and, if the project content is empty, auto-fills it with the README (raw Markdown).
- The GitHub owner/repo/url are stored on the project and a “View on GitHub” link is shown on the public project page.
- Failures (private repo, missing README, rate limits) are non‑blocking; the project is still created.

Authentication (optional): set `GITHUB_TOKEN` in your environment to increase rate limits and avoid anonymous quotas.

1. Edit your environment file:
   - `.env` → add `GITHUB_TOKEN=your_token`
   - Or update `.env.example` for team usage.
2. The token is read via `config/services.php` as `config('services.github.token')`.

Notes:
- Only public repositories are supported for README fetching.
- The README is truncated to the first ~5,000 characters.
