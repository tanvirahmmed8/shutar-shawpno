<h1>Shutar Shawpno – Fashion Theme Frontend</h1>

Production-ready Laravel storefront theme (theme_aster) for a fashion brand. This repo contains customer-facing pages, Blade templates, email templates, and supporting assets. Phase 1–7 modernized the frontend UX, accessibility, performance, and documentation.

Key folders
- resources/themes/theme_aster/theme-views – primary frontend views
- resources/views/email-templates – transactional email templates
- resources/views/layouts/back-end – admin/back-office layouts
- public/ – static assets

Requirements
- PHP 8.1+
- Composer
- Node 16+ and npm
- MySQL or compatible DB

Quick start (local)
1) Copy .env.example to .env and configure DB and mail
2) composer install
3) php artisan key:generate
4) php artisan migrate --seed (if seeders available)
5) npm install
6) npm run dev
7) php artisan serve

Testing
- phpunit: vendor/bin/phpunit or php artisan test
- Minimal smoke tests are included for key guest pages and auth registration view

Build assets
- Development: npm run dev
- Production: npm run production

Accessibility and SEO
- Core pages use semantic landmarks (header, main, footer)
- Meta description and social cards are set from web_config with safe fallbacks
- Buttons/controls include accessible names and ARIA where appropriate

Deployment notes
- Always back up database and storage
- Use composer install --no-dev --optimize-autoloader
- Run migrations with --force and warm caches (config/route/view)
- Build production assets and restart queues
See PHASE_7_COMPLETE.md for the full deploy-ready checklist.

License
This project uses Laravel and is open-sourced software licensed under the MIT license.
