# Fikri Amrullah — Portfolio & Build Log

A Laravel portfolio for Fikri Amrullah, a full-stack developer in Garut, Indonesia. The public site presents project work as technical case studies; the admin area is a working content desk for projects, messages, the public profile, and the CV.

The visual system is documented in [`DESIGN.md`](DESIGN.md) and `.impeccable/design.json`. Product truth and constraints live in [`PRODUCT.md`](PRODUCT.md); the original Indonesian specification is [`PROMPT.MD`](PROMPT.MD).

## Stack

- Laravel 13 on PHP 8.3+ (developed on PHP 8.4)
- Blade, Tailwind CSS 4 (CSS-first, no `tailwind.config.js`), vanilla JavaScript
- MySQL in development and production
- Vite for asset building only; no Node runtime is required on the server
- Pest for tests; SQLite in memory during tests
- Bricolage Grotesque, Instrument Sans, and JetBrains Mono via Bunny Fonts

## What is included

- Public pages: `/`, `/about`, `/skills`, `/projects`, `/projects/{slug}`, `/services`, `/contact`
- Project index as a ledger with category filtering, technical plates, placeholder labels, and featured state
- Project detail pages with problem, solution, implementation, features, stack, links, and gallery
- Contact form with server-side validation, CSRF, a honeypot, rate limiting, database storage, and best-effort email notification
- Admin area under `/admin`: login, dashboard, project CRUD, thumbnail/gallery uploads, draft/published status, featured flag, sort order, message inbox, public profile/CV management, account and password changes
- No public admin registration; the first admin is created with an Artisan command
- Only published projects are public; drafts return 404 even with a known slug
- CV and LinkedIn are hidden until the administrator supplies them
- SEO metadata, Open Graph, canonical URLs, `/sitemap.xml`, and `robots.txt`
- Responsive layouts with no horizontal overflow at 390px, 768px, and 1440px
- Keyboard focus states, semantic landmarks, and `prefers-reduced-motion` support

## Requirements

- PHP 8.3 or newer with the usual Laravel extensions (`pdo_mysql`, `mbstring`, `openssl`, `fileinfo`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`)
- Composer 2
- MySQL 8+ (or MariaDB compatible with the migrations)
- Node.js 20.19+ or 22.12+ and npm for building frontend assets
- A writable `storage/` and `bootstrap/cache/` directory

## Local setup

```bash
composer install
cp .env.example .env          # Windows: copy .env.example .env
php artisan key:generate
```

Configure the database in `.env`:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=my-website-v5
DB_USERNAME=root
DB_PASSWORD=
```

Then migrate, seed, link storage, build assets, and create the first admin:

```bash
php artisan migrate --seed
php artisan storage:link
npm install
npm run build
php artisan admin:create
```

`php artisan admin:create` asks for a name, email, and password. Leaving the password blank generates a 20-character password and prints it once. It can also be used non-interactively:

```bash
php artisan admin:create --name="Fikri Amrullah" --email="fikri.amrulloh15@gmail.com"
```

There is no public registration route. The admin login is `/admin/login`; after login the dashboard is `/admin`.

Start the full development stack with:

```bash
composer dev
```

That runs the Laravel server, queue listener, and Vite together. Do not start `npm run dev` separately.

### Seeded data

`php artisan migrate --seed` seeds:

- The public site profile: Fikri Amrullah, Full Stack Developer, Garut, Indonesia, `fikri.amrulloh15@gmail.com`, and GitHub `https://github.com/massiki`.
- Four clearly labelled placeholder projects, but only in the `local` and `testing` environments. Production seeding creates the site profile only.

The placeholder projects are intentionally marked `is_placeholder` and show a “Contoh” stamp. Replace them through `/admin/projects`; do not present them as real client work.

## Admin workflow

- **Projects:** create, edit, delete, upload a thumbnail, add gallery images, set draft/published, mark featured, and control sort order. Slugs are generated from the title and can be edited.
- **Messages:** read the inbox, mark messages read/unread, and delete them. Messages are stored before any email is sent.
- **Profile & CV:** update the public name, role, location, email, GitHub URL, and optional LinkedIn URL. Upload or remove the CV PDF/document. The public CV button stays hidden until a file exists.
- **Account:** change the admin name/email and password. Password changes require the current password.

Uploaded files use Laravel’s `public` disk. Run `php artisan storage:link` after deployment and keep `storage/app/public` writable.

## Contact form

The form validates on the server, stores the message in `contact_messages`, then attempts to email the address in the site profile. A mail failure is logged and does not lose the message.

- Honeypot: hidden `website` field; filled submissions are silently accepted and discarded.
- Rate limit: 5 submissions per minute per IP.
- Local mail: `MAIL_MAILER=log`, so messages appear in `storage/logs/laravel.log`.
- Production: configure SMTP in `.env` and keep `QUEUE_CONNECTION=sync` on shared hosting. The notification is sent inline, not through a background worker.

## CV and LinkedIn

Both are intentionally absent until real data is supplied.

- Upload the CV at `/admin/profile`. The public download action is hidden while no CV exists.
- Add a LinkedIn URL at `/admin/profile` when one is available. Until then, the LinkedIn link is hidden from the public site.

## SEO

- Per-page title, description, canonical URL, Open Graph, and Twitter card metadata.
- Person and CreativeWork JSON-LD on the home and project detail pages.
- `/sitemap.xml` is generated from published projects and the public pages.
- `public/robots.txt` disallows `/admin` and `/admin/`.

Set `APP_URL` to the production URL before generating canonical URLs or the sitemap. When the domain is known, add an absolute `Sitemap:` line to `public/robots.txt`:

```text
Sitemap: https://your-domain.example/sitemap.xml
```

## Tests and formatting

```bash
composer test
# or
php artisan test

vendor/bin/pint
```

Tests use in-memory SQLite from `phpunit.xml`; `RefreshDatabase` is enabled globally for feature tests in `tests/Pest.php`. Keep migrations and queries portable, and verify MySQL-specific work against the development database.

Useful focused runs:

```bash
php artisan test --filter=ContactTest
vendor/bin/pest tests/Feature/AdminProjectTest.php
```

## Shared-hosting deployment

The application is designed for shared hosting with MySQL, no Node runtime, and no long-running queue worker.

### 1. Build assets locally

```bash
npm ci
npm run build
```

Commit or upload `public/build/` and `public/build/fonts-manifest.json`. Do not upload `node_modules/`.

### 2. Upload the application

Upload the project outside the public web root where possible, then point the domain’s document root to `public/`.

If the host does not allow changing the document root, move the contents of `public/` into `public_html/` and update the paths in `public_html/index.php` so they resolve to the application directory. Keep `.env`, `storage/`, and `vendor/` outside the web root.

### 3. Install PHP dependencies

With SSH:

```bash
composer install --no-dev --optimize-autoloader
```

Without SSH, upload a production `vendor/` directory built locally with the same PHP version and extensions.

### 4. Configure production `.env`

```dotenv
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.example

DB_CONNECTION=mysql
DB_HOST=...
DB_PORT=3306
DB_DATABASE=...
DB_USERNAME=...
DB_PASSWORD=...

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=sync
FILESYSTEM_DISK=local

MAIL_MAILER=smtp
MAIL_SCHEME=smtp
MAIL_HOST=...
MAIL_PORT=587
MAIL_USERNAME=...
MAIL_PASSWORD=...
MAIL_FROM_ADDRESS="fikri.amrulloh15@gmail.com"
MAIL_FROM_NAME="Fikri Amrullah"
```

Use a strong, unique `APP_KEY` generated on the server with `php artisan key:generate --show` (or copy the local key only if you understand the consequences). Never commit `.env`.

### 5. Migrate and seed

```bash
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link
```

In production, `db:seed` creates the site profile only; the four demo projects are not seeded outside `local`/`testing`.

### 6. Create the admin

```bash
php artisan admin:create
```

Use a strong password and store it in a password manager. There is no public registration path.

### 7. Cache and permissions

```bash
php artisan optimize
```

Ensure these are writable by the web server:

- `storage/`
- `storage/framework/`
- `storage/logs/`
- `bootstrap/cache/`
- `storage/app/public/`

If `php artisan storage:link` cannot create a symlink on the host, ask the host to enable symlinks or configure the public disk to a web-accessible directory. Do not store uploads inside `public/` directly.

### 8. Verify

- `/` loads with the correct canonical URL and fonts.
- `/admin/login` loads over HTTPS.
- A draft project returns 404 at `/projects/{slug}`.
- Uploading a CV makes the public download action appear.
- A contact submission appears in `/admin/messages` and the notification email is delivered.
- `/sitemap.xml` lists only published projects.
- `robots.txt` disallows `/admin`.

## Project structure

```text
app/
  Console/Commands/CreateAdminCommand.php   first-admin provisioning
  Enums/                                    project and message states
  Http/Controllers/                         public and admin controllers
  Http/Requests/                            server-side validation
  Mail/ContactMessageReceived.php           contact notification
  Models/                                   Project, ProjectImage, ContactMessage, SiteProfile, User
database/
  migrations/                               schema
  seeders/                                  site profile + local demo projects
resources/
  css/app.css                               Tailwind 4 theme and component layer
  js/app.js                                 navigation, filters, reveal, dialogs, previews
  views/                                    public, admin, auth, mail, sitemap
routes/web.php                              web-only routes
tests/Feature/                              public and admin coverage
DESIGN.md                                   design-system tokens and rules
```

## Notes

- UI copy is Indonesian; technical terms may stay in English.
- Do not add React, Vue, Next.js, Prisma, a separate API backend, or Node server code. Node is only for Vite.
- Do not invent clients, employers, metrics, testimonials, or project outcomes. Replace placeholder content with real material through the admin.
- The public project queries exclude drafts at the query level; do not rely on hidden UI for authorization.
- If you change the design system, update both `DESIGN.md` and `.impeccable/design.json`.
