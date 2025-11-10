# LaunchFil

[![Latest Version on Packagist](https://img.shields.io/packagist/v/wjbecker/launchfil)](https://packagist.org/packages/wjbecker/launchfil)
![PHP Version](https://img.shields.io/badge/PHP-8.2+-blue.svg)
[![License](https://img.shields.io/packagist/l/wjbecker/launchfil)](LICENSE)
<a href="https://herd.laravel.com/new?starter-kit=wjbecker/launchfil"><img src="https://img.shields.io/badge/Install%20with%20Herd-f55247?logo=laravel&logoColor=white"></a>

> **Launch your next Filament-powered Laravel app with zero boilerplate.**

**LaunchFil** is an opinionated Laravel starter kit built around Filament (v4) and a modern developer workflow. It comes pre-configured with authentication, roles & permissions, social login, and a full local dev setup — ready for you to start building.

---

## Features

- **Pre-configured Filament 4 stack** — including Shield, Breezy, and Socialite integration
- **Role & permission system** powered by Filament Shield
- **Social login support** via Microsoft Azure and SocialiteProviders
- **Pre-built user management panel** with TomatoPHP Users
- **Modern dev tooling** — Pest, Pint, Rector, Larastan, Vite, and NPM scripts ready to go
- **Zero-friction setup** — run `composer setup` and start coding

---

## Quick Start

You can install this starter kit by running the commands below or by clicking the "Install with Herd" badge above

```bash
composer create-project wjbecker/launchfil --prefer-dist myapp
        or
laravel new myapp --using=wjbecker/launchfil

cd myapp
composer setup
```

---

## Philosophy

LaunchFil removes the boilerplate from building Laravel + Filament apps.
It gives you a clean, extensible foundation for modern admin apps, SaaS dashboards, or internal tools — with the tooling and workflow already wired.

---

## Package Overview

| Layer | Package / Tool |
|-------|----------------|
| UI & Admin | [Filament v4](https://filamentphp.com) |
| Auth & Roles | [Breezy](https://github.com/jeffgreco13/filament-breezy), [Shield](https://github.com/bezhanSalleh/filament-shield) |
| Social Login | [Socialite + Microsoft Azure](https://socialiteproviders.com/) |
| Code Quality | Pest, Pint, Rector, Larastan |
| Dev Workflow | npm + Vite, Artisan scripts, Laravel Boost & Pail |
| UI Icons | Blade FontAwesome |

---

## Tooling

LaunchFil includes a rich set of preconfigured **Composer scripts** that streamline your development workflow.

| Script | Description |
|--------|--------------|
| `composer setup` | Installs dependencies, creates `.env`, generates app key, migrates & seeds the database, generates Filament Shield permissions, sets up a super admin, installs NPM dependencies, and builds assets. Use this right after cloning. |
| `composer dev` | Runs multiple processes simultaneously using `concurrently`: <br>• Laravel dev server <br>• Queue worker <br>• Pail log stream <br>• Vite dev server <br>Perfect for local development. |
| `composer update:requirements` | Updates all Composer and NPM dependencies. It runs `composer bump` followed by `npx npm-check-updates -u`, ensuring all packages stay current. |
| `composer lint` | Runs code quality tools: Rector, Pint (PHP linter/formatter), and `npm run lint`. Use before committing. |
| `composer test` | Runs the full testing suite — type coverage, unit tests, lint tests, and static analysis — ensuring the project meets quality standards. |
| `composer test:type-coverage` | Ensures 100% type coverage with Pest. |
| `composer test:unit` | Runs the unit test suite with Pest in parallel and reports coverage. |
| `composer test:lint` | Dry‑runs Pint and Rector, and executes `npm run test:lint`. |
| `composer test:types` | Runs Larastan (PHPStan for Laravel) for advanced static analysis. |
| `composer post-update-cmd` | Automatically runs asset publishing, clears cache, and ensures requirements are updated after Composer updates. |
| `composer post-autoload-dump` | Discovers Laravel packages and ensures Filament is upgraded after every autoload dump. |

> Tip: These scripts are chained together intentionally.  
> For example, `composer test` will automatically call all test‑related scripts in sequence.

---

## License

Licensed under the **MIT License** — free for personal and commercial use.

---

### Feedback & Contributions

Pull requests, ideas, and issues are welcome.
