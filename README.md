# KozerTravel

KozerTravel is an SEO-focused travel discovery and affiliate platform built with Laravel.

---

## Features

- Flight & hotel search
- Affiliate click tracking
- Dynamic SEO landing pages
- Blog CMS
- Newsletter system
- Admin dashboard
- Sitemap & robots support
- Search analytics tracking

---

## Tech Stack

- PHP 8.3
- Laravel
- Blade Templates
- Vite
- MySQL / SQLite
- JavaScript
- CSS

---

## Project Structure

```bash
app/
bootstrap/
config/
database/
public/
resources/
routes/
storage/
tests/
```

---

## Installation

Clone the repository:

```bash
git clone https://github.com/Kozer94/kozertravel.git
```

Move into project directory:

```bash
cd kozertravel
```

Install dependencies:

```bash
composer install
npm install
```

Create environment file:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Run migrations:

```bash
php artisan migrate
```

Build frontend assets:

```bash
npm run build
```

Start development server:

```bash
php artisan serve
```

---

## Deployment

Supported deployment environments:

- Hostinger
- Railway
- VPS
- Shared Hosting

Deployment-related files:

```bash
README.deploy.md
build.sh
railway.json
nixpacks.toml
Procfile
```

---

## Current Focus

- SEO optimization
- Affiliate infrastructure
- Performance optimization
- Production hardening
- Search scalability

---

## Roadmap

- Redis caching
- Queue system
- Advanced analytics
- AI-generated travel pages
- Search engine optimization
- Tracking anti-fraud protection

---

## Security Notes

Before production deployment:

- Disable debug mode
- Configure secure session cookies
- Add rate limiting
- Protect admin routes
- Review environment variables
- Enable backups and monitoring

---

## License

MIT
