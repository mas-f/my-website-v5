# AGENTS.md

## Project

- Laravel 13 portfolio for Fikri Amrullah on PHP 8.4 locally; `composer.json` requires PHP `^8.3`.
- Public pages: `/`, `/about`, `/skills`, `/projects`, `/projects/{slug}`, `/services`, `/contact`.
- Admin lives under `/admin`: dashboard, project CRUD, gallery/thumbnail uploads, messages, public profile/CV, and account settings. There is no public registration.
- `PROMPT.MD` is the authoritative product spec (Indonesian). `PRODUCT.md` records confirmed product truth and constraints. `DESIGN.md` and `.impeccable/design.json` record the shipped visual system; update both when the design changes.
- Domain models: `Project` (draft/published, featured, sort order, placeholder flag), optional `ProjectImage` gallery, `ContactMessage`, singleton `SiteProfile`, and `User` as admin.
- UI copy is Indonesian. Do not invent personal data, clients, metrics, achievements, or project outcomes; leave obvious placeholders until the user supplies real content.
- Stack is fixed: Blade + Tailwind CSS 4 + vanilla JS + MySQL. Do not add React/Vue/Next/Prisma, a separate API backend, or Node server code. Node is only for Vite tooling.
- Routes are web-only (`routes/web.php`, no `api.php`).

## Commands

- `composer dev` or `php artisan dev` starts server + `queue:listen` + Vite together (Windows uses `concurrently`). Do not start `npm run dev` separately.
- `npm run dev` / `npm run build` for the frontend only.
- `composer test` clears config then runs `php artisan test` (Pest). Focused: `php artisan test --filter=Name` or `vendor/bin/pest tests/Feature/FooTest.php`.
- `vendor/bin/pint` formats PHP (no `pint.json`; defaults apply).
- First-time setup: `composer setup`, then `php artisan migrate --seed`, `php artisan storage:link`, `npm run build`, and `php artisan admin:create`.
- `php artisan admin:create` supports `--name`, `--email`, and `--password`; a blank interactive password is generated and printed once. Never hardcode admin credentials in source.
- `php artisan boost:update` refreshes Boost guidelines/skills and runs on `composer update`; it may rewrite this file. Re-apply local notes if it does.

## Database and testing

- Dev DB is MySQL (`DB_CONNECTION=mysql`, database `my-website-v5` in `.env`). `.env.example` now defaults to MySQL as well.
- Tests use in-memory SQLite from `phpunit.xml`, not MySQL. Keep migrations and queries portable; verify MySQL-specific work against the dev DB.
- Pest 5. `RefreshDatabase` is enabled globally for feature tests in `tests/Pest.php`.
- Tests run through Laravel Pao and print JSON when an agent runs them; that is expected.
- Public project queries must exclude drafts, including direct slug access. Admin authorization must be enforced server-side, not by hiding UI.
- `DatabaseSeeder` always seeds `SiteProfileSeeder`; `DemoProjectSeeder` runs only in `local` and `testing`, so production seeding creates the profile only.

## Frontend

- Tailwind CSS 4 is CSS-first: there is no `tailwind.config.js`. Put design tokens in `@theme` and content paths in `@source` inside `resources/css/app.css`.
- Vite inputs are `resources/css/app.css` and `resources/js/app.js`. Fonts are Bricolage Grotesque (display), Instrument Sans (body), and JetBrains Mono (labels), bundled via `laravel-vite-plugin` fonts.
- `.npmrc` sets `ignore-scripts=true`, so npm lifecycle scripts do not run during install.
- Follow `DESIGN.md`: light editorial Build Log, cool paper ground, graphite ink, measured cobalt annotation, manila index tabs, ledger rows, thin warm rules, and soft paper-lift shadows.
- Keep the drafting grid faint and on section headers/plates; do not use it behind long-form body copy.
- Do not put kickers/eyebrows directly above headings; use the 3-column left margin or a metadata strip. Do not use colored left borders thicker than 1px on cards/callouts.
- Responsive navs and the admin sidebar use the `hidden` class, not the HTML `hidden` attribute, because Tailwind preflight makes `[hidden]` important and it would beat `lg:block`. `resources/js/app.js` toggles the class.
- Interactions are CSS/vanilla JS: mobile nav, project filters, reveal-on-scroll, confirm dialog, contact submit state, image preview, and diagram replay. Honor `prefers-reduced-motion`.

## Environment

- The workspace has a `.git` directory. Do not run `git init` or rewrite history; inspect the working tree before large edits because uncommitted changes may exist.
- `.editorconfig`: 4-space PHP/JS, LF line endings, final newline.
- `CLAUDE.md` only points here; `AGENTS.md` is the source of truth.
- Deployment target is shared hosting: prebuild `public/build`, point the document root at `public/`, run migrations, link storage, and keep `QUEUE_CONNECTION=sync`. See `README.md` for the full deployment sequence.
