# Environment Keys (guide)

This document organizes and explains environment variables following the same structure as `.env.example`. It includes what each key is for and how to obtain or set it.

Note: Example defaults are generally fine for local development. Adjust as needed for production.

## Application

-   APP_NAME: Application name, used in branding and emails. How to get: choose a name (e.g., "Proctique").
-   APP_ENV: Runtime environment. Values: `local`, `production`, `staging`. How to get: set per deployment target.
-   APP_KEY: Laravel encryption key. How to get: run `php artisan key:generate` (generated during setup).
-   APP_DEBUG: Debug mode. `true` in development, `false` in production. How to get: set per environment.
-   APP_URL: Base URL of the app (no trailing slash). How to get: your public or local URL (e.g., `http://localhost`).

## Localization

-   APP_LOCALE: Default language (e.g., `en`, `es`).
-   APP_FALLBACK_LOCALE: Fallback language when a translation is missing.
-   APP_FAKER_LOCALE: Faker locale for fake data (e.g., `en_US`, `es_ES`).

## Maintenance

-   APP_MAINTENANCE_DRIVER: Maintenance driver. Usually `file`.
-   APP_MAINTENANCE_STORE (optional): Cache store for maintenance (e.g., `database`). Only if you use a driver other than `file`.

## PHP Server (optional)

-   PHP_CLI_SERVER_WORKERS: Number of workers for PHP’s built-in server. Rarely used in dev.

## Security / Hashing

-   BCRYPT_ROUNDS: bcrypt cost. Higher = more secure but slower. 12–14 is common in prod.

## Logging

-   LOG_CHANNEL: Default channel (`stack`, `single`, etc.).
-   LOG_STACK: Comma-separated channels when `LOG_CHANNEL=stack`.
-   LOG_DEPRECATIONS_CHANNEL: Channel for deprecations (e.g., `null` or `stack`).
-   LOG_LEVEL: Minimum log level (`debug`, `info`, `warning`, `error`, ...).

## Database

-   DB_CONNECTION: Database driver (`sqlite`, `mysql`, `pgsql`).
-   DB_HOST (mysql/pgsql): Database host.
-   DB_PORT (mysql/pgsql): Port (MySQL 3306, Postgres 5432).
-   DB_DATABASE: Database name or `sqlite` file path.
-   DB_USERNAME: Database user.
-   DB_PASSWORD: Database password.
    How to get: credentials from your DB service (local Docker, cloud service, etc.).

## Sessions

-   SESSION_DRIVER: Session driver (`file`, `database`, `redis`).
-   SESSION_LIFETIME: Session duration in minutes.
-   SESSION_ENCRYPT: Encrypt session payload (`true`/`false`).
-   SESSION_PATH: Session cookie path (typically `/`).
-   SESSION_DOMAIN: Cookie domain (e.g., `.yourdomain.com`), `null` for auto.

## Core Services

-   BROADCAST_CONNECTION: Broadcasting driver (e.g., `log`, `pusher`).
-   FILESYSTEM_DISK: Default filesystem disk (`local`, `public`, `s3`).
-   QUEUE_CONNECTION: Queue connection (`database`, `redis`, `sync`, `sqs`).

## Cache

-   CACHE_STORE: Default cache store (`file`, `redis`, `memcached`).
-   CACHE_PREFIX (optional): Prefix for cache keys when sharing storage.

## Memcached (optional)

-   MEMCACHED_HOST: Memcached host (if using that store).

## Redis (optional)

-   REDIS_CLIENT: Client (`phpredis` or `predis`).
-   REDIS_HOST: Redis server host.
-   REDIS_PASSWORD: Password if required, `null` otherwise.
-   REDIS_PORT: Port (default 6379).

## Mail

-   MAIL_MAILER: Mail driver (`log`, `smtp`, `sendmail`, `postmark`, `resend`).
-   MAIL_SCHEME (optional): Scheme for SMTP URL when using `MAIL_URL`.
-   MAIL_HOST: SMTP host.
-   MAIL_PORT: SMTP port.
-   MAIL_USERNAME: SMTP username (if applicable).
-   MAIL_PASSWORD: SMTP password (if applicable).
-   MAIL_FROM_ADDRESS: Default sender email.
-   MAIL_FROM_NAME: Default sender name.
    How to get: credentials from your email provider (Postmark, Resend, Mailgun, your SMTP, etc.).

## AWS / S3 (optional)

-   AWS_ACCESS_KEY_ID: Access Key.
-   AWS_SECRET_ACCESS_KEY: Secret Key.
-   AWS_DEFAULT_REGION: Region (e.g., `us-east-1`).
-   AWS_BUCKET: S3 bucket to use.
-   AWS_USE_PATH_STYLE_ENDPOINT: `false` for AWS; `true` for MinIO/compatible.
    How to get: create an IAM user with S3 permissions and generate access keys.

## Frontend (Vite)

-   VITE_APP_NAME: Name displayed in the frontend. Usually the same as `APP_NAME`.

## GitHub (optional)

-   GITHUB_TOKEN: Personal access token used for GitHub API requests to fetch repository READMEs during project creation and to increase rate limits.
    How to get: create a GitHub personal access token. A classic token with `public_repo` scope or a fine‑grained token with read access to public repositories is sufficient. Leave empty to use unauthenticated requests (subject to stricter rate limits).

---

Other project/feature-specific settings (optional)

These keys are not in `.env.example` but are used by the project or packages. Only set them if you enable those integrations.

-   ADMIN_CODE: Admin code to grant elevated access. How to get: choose a secret value and rotate in production.
-   FLARE_KEY: Flare/Flare-Ignition API key for error reporting. How to get: from your Flare account.
-   LOG_SLACK_WEBHOOK_URL: Slack Incoming Webhook for logs. How to get: create a webhook in your Slack workspace.
-   POSTMARK_API_KEY: Postmark API key (if using that mailer). How to get: from your Postmark account.
-   RESEND_API_KEY: Resend API key (if using that mailer). How to get: from your Resend account.
-   MEDIA_DISK: Disk for Spatie Media Library (`public`, `s3`). How to get: choose a disk defined in `config/filesystems.php`.
-   MEDIA*QUEUE / QUEUE_CONVERSIONS*\*: Configure queues for media conversions. Requires a working queue system.
-   LIVEWIRE_TEMPORARY_FILE_UPLOAD_DISK: Temporary disk for Livewire uploads.
-   IMAGE_DRIVER: Image manipulation driver (`gd` or `imagick`).
-   DEBUGBAR_ENABLED: Enable Laravel Debugbar in local. Do not enable in production.

## UI Limits

-   MAX_IMAGE_UPLOAD_KB: Maximum image upload size (in kilobytes) enforced by the image input UI. Default `2048`. How to get: choose a limit appropriate for your app and environment.

For additional advanced options (extra Redis, SQS, Papertrail, granular Debugbar, etc.), check the corresponding `config/*.php` files where all `env()` keys are defined.

## Mollie Payment

- MOLLIE_KEY: Mollie api key
