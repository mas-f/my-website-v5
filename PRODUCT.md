# Product

<!-- impeccable:product-schema 1 -->

## Platform

web

## Stack

Laravel 13 + Blade + Tailwind CSS 4 + vanilla JavaScript + MySQL. Laravel Breeze is used only for authentication scaffolding; no frontend framework or separate API backend. Vite is build tooling only.

## Users

- Recruiters and hiring managers evaluating Fikri Amrullah for full-stack developer roles.
- Prospective freelance clients evaluating whether he can build and maintain a complete Laravel application.
- Fikri himself, as the sole administrator, maintaining projects, messages, public profile, and CV without editing source code.

## Product Purpose

A professional personal portfolio for Fikri Amrullah, a full-stack developer based in Garut, Indonesia. It presents real project work as technical case studies and proves full-stack capability through a working Laravel admin dashboard. Success means a visitor understands the developer's focus, can inspect credible project details, and can make contact or download the CV.

## Positioning

The portfolio is both the proof and the product: every public project is managed through a real Laravel admin, and each case study explains the problem, solution, implementation, and technical decisions rather than presenting a gallery of screenshots.

## Operating Context

- Public pages: home, about, skills, projects, project detail, services, contact.
- Admin area under `/admin`: dashboard, project CRUD, message management, public profile, profile photo, and CV management.
- Content language is Indonesian; technical terms may remain in English.
- Projects are stored in MySQL and published or drafted from the admin.
- Contact messages are stored before any email notification is attempted.
- The site will be deployed to shared hosting with MySQL, a public document root, and prebuilt Vite assets.

## Capabilities and Constraints

- Laravel routing, controllers, middleware, validation, Eloquent, migrations, seeders, authentication, authorization, storage, and rate limiting.
- Tailwind CSS 4 is CSS-first; no `tailwind.config.js`.
- JavaScript is vanilla; Breeze's Alpine dependency must not become the interaction framework.
- No public admin registration. The first admin is created through a secure Artisan command.
- Only published projects are visible publicly; drafts must return 404 even with a known slug.
- CV upload accepts a document file and is managed from the admin profile.
- Profile photo upload accepts JPEG, JPG, PNG, or WebP up to 2 MB and is managed from the admin profile; SVG is not accepted. The home hero displays it as a 4:5 portrait plate with CSS `object-fit: cover`; no server-side crop or resize is performed. A provisional placeholder appears until a photo is uploaded.
- Site logo upload accepts JPEG, JPG, PNG, or WebP and is managed from the admin profile; the public header falls back to the FA monogram when no logo is set. Each upload also generates a 64×64 PNG favicon for the browser tab, with `public/favicon.svg` as the fallback when no logo exists.
- Images use Laravel Storage and the public disk; uploads are validated.
- SEO basics: metadata, Open Graph, canonical URL, sitemap, robots.
- Shared hosting constraints: no Node runtime, no long-running queue worker assumed, document root must resolve to `public/`.

## Brand Commitments

- Name: Fikri Amrullah.
- Role: Full Stack Developer.
- Location: Garut, Indonesia.
- Public email: fikri.amrulloh15@gmail.com.
- GitHub: https://github.com/massiki.
- LinkedIn: not provided; hide the link until the administrator adds it.
- CV: not provided; the public download action stays unavailable until uploaded through admin.
- Visual direction: modern, minimalist, editorial, professional, light mode, off-white ground, charcoal text, measured cobalt/electric-blue accent, thin borders, soft shadows, generous whitespace.
- Do not fabricate employers, clients, project outcomes, metrics, certifications, or testimonials.

## Evidence on Hand

- Real identity and GitHub URL.
- No real project content yet. Four clearly labelled placeholder projects may be seeded locally and replaced through the admin.
- No CV file, LinkedIn URL, uploaded profile photograph, or project thumbnails yet. The home hero shows a provisional portrait placeholder until a photo is uploaded.
- The design reference is https://dennamandela.vercel.app; use its editorial discipline and numbered narrative structure as inspiration, not as content or a template to copy.

## Product Principles

1. Show the work, not just the claim: every project explains problem, solution, implementation, and trade-offs.
2. Make the backend visible through a genuinely usable admin, not a mock dashboard.
3. Keep the public experience fast, readable, and honest; placeholder content must look intentionally provisional.
4. Treat security and authorization as server-side facts, never as hidden UI.
5. Respect the shared-hosting reality: portable migrations, prebuilt assets, and documented deployment steps.

## Accessibility & Inclusion

- Responsive from mobile through desktop with no horizontal overflow.
- Keyboard-operable navigation, forms, and dialogs with visible focus states.
- Semantic headings, labelled form controls, alt text for meaningful images, and reduced-motion support.
- Body text and controls meet WCAG AA contrast.
