# AGENTS.md

## Project

- Laravel 13 app on PHP 8.4 locally; `composer.json` requires PHP `^8.3`.
- Still the bare skeleton: only `/` exists (`routes/web.php` -> `welcome` view). Public pages, models, auth, and admin are not built yet.
- `PROMPT.MD` is the authoritative product spec (Indonesian). Read it before implementing features. It defines the public pages, admin surface, schema, and definition of done.
- Domain target: `Project` (draft/published, featured, sort order), optional `ProjectImage` gallery, `ContactMessage`, and `User` as admin. Admin lives under `/admin` with no public registration.
- UI copy is Indonesian. Do not invent personal data, projects, clients, or achievements; leave obvious placeholders until the user supplies real content.
- Stack is fixed: Blade + Tailwind + vanilla JS + MySQL. Do not add React/Vue/Next/Prisma, a separate API backend, or Node server code. Node is only for Vite tooling.
- Routes are web-only (`routes/web.php`, no `api.php`).

## Commands

- `composer dev` or `php artisan dev` starts server + `queue:listen` + Vite together (Windows uses `concurrently`). Do not start `npm run dev` separately.
- `npm run dev` / `npm run build` for the frontend only.
- `composer test` clears config then runs `php artisan test` (Pest). Focused: `php artisan test --filter=Name` or `vendor/bin/pest tests/Feature/FooTest.php`.
- `vendor/bin/pint` formats PHP (no `pint.json`; defaults apply).
- First-time setup: `composer setup`. Run `php artisan storage:link` before relying on public image URLs.
- `php artisan boost:update` refreshes Boost guidelines/skills and runs on `composer update`; it may rewrite this file. Re-apply local notes if it does.

## Database and testing

- Dev DB is MySQL (`DB_CONNECTION=mysql`, database `my-website-v5` in `.env`). `PROMPT.MD` requires MySQL, but `.env.example` still defaults to SQLite.
- Tests use in-memory SQLite from `phpunit.xml`, not MySQL. Keep migrations and queries portable; verify MySQL-specific work against the dev DB.
- Pest 5. `RefreshDatabase` is commented out in `tests/Pest.php`, so DB-touching tests need `uses(RefreshDatabase::class)` (per file or globally).
- Tests run through Laravel Pao and print JSON when an agent runs them; that is expected.
- Public project queries must exclude drafts, including direct slug access. Admin authorization must be enforced server-side, not by hiding UI.

## Frontend

- Tailwind CSS 4 is CSS-first: there is no `tailwind.config.js`. Put design tokens in `@theme` and content paths in `@source` inside `resources/css/app.css`.
- Vite inputs are `resources/css/app.css` and `resources/js/app.js`; Instrument Sans is bundled via `laravel-vite-plugin` fonts.
- `.npmrc` sets `ignore-scripts=true`, so npm lifecycle scripts do not run during install.
- Follow the spec's visual direction: light, editorial, cobalt/electric-blue accent, responsive, keyboard accessible, and honoring `prefers-reduced-motion`. Use CSS/vanilla JS for interactions.

## Environment

- This directory is not a git repository; do not rely on git history, diffs, or branches.
- `.editorconfig`: 4-space PHP/JS, LF line endings, final newline.
- `CLAUDE.md` only points here; `AGENTS.md` is the source of truth.
