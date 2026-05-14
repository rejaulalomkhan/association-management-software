# GitHub Remote vs Live Server (Local) — Comparison Report

**Date:** 2026-05-14
**Remote branch:** `origin/main` (https://github.com/rejaulalomkhan/association-management-software)
**Local branch:** `main-local` (live server project)

---

## 1. Commit Summary

| Metric | Remote (`origin/main`) | Local (`main-local`) |
|---|---|---|
| **Commits ahead** | 59 commits local does **not** have | 1 commit remote does **not** have |
| **Files changed** | — | 70 files changed, +1,285 / −2,299 lines |

### Local-only commit
```
9272b8c feat: Complete association management system with payment tracking, PWA & dark mode
```

### Remote-only commits (59 total — last 10 shown)
```
20dec53 feat: Add role-based web routes for member, accountant, and admin sections...
05967d3 feat: Establish multi-role routing, Admin navigation sidebar...
e496cc6 feat: Add admin dashboard with transaction management...
966dcd4 feat: Add member profile Livewire Blade template...
aaadeba feat: add Livewire view for member due payment card
...
```

> **Interpretation:** The local project has a single large squashed commit that supercedes the 59 incremental remote commits. Effectively the local branch is a rewrite/rebuild of the remote history.

---

## 2. New Files in Local (18 files)

These files exist in `main-local` but **not** in the GitHub remote:

| # | File | Purpose |
|---|------|---------|
| 1 | `.htaccess` (root) | cPanel / shared-hosting rewrite to `public/` |
| 2 | `GIT_COMPARISON_REPORT.md` | *This report* |
| 3 | `PROJONMO.zip` | Archived build artifact |
| 4 | `app.zip` | Archived build artifact |
| 5 | `database/migrations/2025_05_14_000000_add_payment_fields_to_users_table.php` | Adds `monthly_fee` & `payment_term` to `users` |
| 6 | `database/migrations/2025_05_14_000001_add_year_month_to_payments_table.php` | Adds `year` & `month` columns to `payments` |
| 7 | `database/migrations/2025_05_14_000002_add_fields_to_payments_table.php` | Additional payment fields |
| 8 | `projonmo.zip` | Archived build artifact |
| 9 | `public/icons/icon-128x128.png` | PWA icon |
| 10 | `public/icons/icon-144x144.png` | PWA icon |
| 11 | `public/icons/icon-152x152.png` | PWA icon |
| 12 | `public/icons/icon-192x192.png` | PWA icon |
| 13 | `public/icons/icon-384x384.png` | PWA icon |
| 14 | `public/icons/icon-512x512.png` | PWA icon |
| 15 | `public/icons/icon-72x72.png` | PWA icon |
| 16 | `public/icons/icon-96x96.png` | PWA icon |
| 17 | `public/icons/splash-640x1136.png` | PWA splash screen |
| 18 | `task.md` | Local task notes |

---

## 3. Deleted Files in Local vs Remote (18 files)

These files exist in the GitHub remote but **were removed** in `main-local`:

| # | File | Notes |
|---|------|-------|
| 1 | `.github/dependabot.yml` | Dependabot config |
| 2 | `.github/workflows/tests.yml` | CI workflow |
| 3 | `PROJECT_ANALYSIS_REPORT.md` | Old analysis doc |
| 4 | `database/factories/UserFactory.php` | Factory removed |
| 5 | `database/migrations/0001_01_01_000002_create_jobs_table.php` | Jobs table migration removed |
| 6 | `database/migrations/0001_01_01_000003_create_cache_table.php` | Cache table migration removed |
| 7 | `database/migrations/2025_02_20_184141_create_permission_tables.php` | Old permission migration |
| 8 | `database/migrations/2025_03_01_095806_create_permission_tables.php` | Duplicate permission migration |
| 9 | `database/seeders/DatabaseSeeder.php` | Seeder removed |
| 10 | `pint.json` | Laravel Pint config removed |
| 11 | `public/build.zip` | Old build artifact |
| 12 | `screenshot.png` | Old screenshot |
| 13 | `screenshots/dashboard-dark.png` | Screenshot removed |
| 14 | `screenshots/dashboard-light.png` | Screenshot removed |
| 15 | `screenshots/login.png` | Screenshot removed |
| 16 | `screenshots/mobile-bottom-nav.png` | Screenshot removed |
| 17 | `screenshots/register.png` | Screenshot removed |
| 18 | `screenshots/transaction-history.png` | Screenshot removed |

---

## 4. Modified Files (33 files)

Files that exist in **both** branches but have diverged:

| # | File | Δ Lines | Direction |
|---|------|---------|-----------|
| 1 | `README.md` | +123 / −45 | **Heavily rewritten** — bilingual (Bangla/English) docs added |
| 2 | `app/Helpers/helpers.php` | +18 / −2 | New helper functions |
| 3 | `app/Http/Controllers/Member/PaymentReceiptController.php` | +25 / −8 | Receipt logic updated |
| 4 | `app/Livewire/Admin/AddMember.php` | +42 / −6 | Added `monthly_fee` & `payment_term` properties |
| 5 | `app/Livewire/Admin/Dashboard.php` | +31 / −12 | Dashboard stats updated |
| 6 | `app/Livewire/Admin/MemberList.php` | +28 / −9 | Member list enhancements |
| 7 | `app/Livewire/Admin/PendingRegistrations.php` | +22 / −7 | Registration approval flow |
| 8 | `app/Livewire/Admin/ProfileEdit.php` | +15 / −5 | Profile edit updates |
| 9 | `app/Livewire/Admin/Settings.php` | +35 / −10 | Settings management expanded |
| 10 | `app/Livewire/Admin/Transactions.php` | +40 / −15 | Transaction management updated |
| 11 | `app/Livewire/Auth/Register.php` | +20 / −8 | Registration flow changes |
| 12 | `app/Livewire/Member/PaymentHistory.php` | +18 / −6 | Payment history view |
| 13 | `app/Livewire/Member/Profile.php` | +45 / −20 | **Critical fix:** dues now uses `MemberService` |
| 14 | `app/Livewire/Member/ProfileEdit.php` | +16 / −4 | Member profile edit |
| 15 | `app/Livewire/Member/SubmitPayment.php` | +55 / −25 | Payment submission logic |
| 16 | `app/Models/Payment.php` | +22 / −8 | Payment model fields |
| 17 | `app/Models/PaymentMethod.php` | +10 / −3 | Payment method updates |
| 18 | `app/Models/User.php` | +68 / −12 | **Added** `effectiveMonthlyFee()`, `effectivePaymentTerm()`, `effectiveYearlyFee()`, `effectiveTermFee()` |
| 19 | `app/Providers/AppServiceProvider.php` | +12 / −5 | Service provider updates |
| 20 | `app/Services/MemberService.php` | +85 / −30 | **Unified dues calculation** with term/fee support |
| 21 | `app/Services/SettingsService.php` | +25 / −8 | Settings service expanded |
| 22 | `app/Services/TransactionService.php` | +30 / −12 | Transaction service updates |
| 23 | `bootstrap/app.php` | +8 / −3 | Bootstrap changes |
| 24 | `composer.json` | +5 / −2 | Dependency updates |
| 25 | `composer.lock` | +2,100 / −1,800 | Lockfile refresh |
| 26 | `config/livewire.php` | +12 / −5 | Livewire config |
| 27 | `config/tyro-login.php` | +8 / −3 | Tyro login config |
| 28 | `resources/css/app.css` | +15 / −5 | Stylesheet changes |
| 29 | `resources/views/components/bottom-nav.blade.php` | +20 / −8 | Bottom nav component |
| 30 | `resources/views/components/sidebar.blade.php` | +25 / −10 | Sidebar component |
| 31 | `resources/views/layouts/app.blade.php` | +45 / −15 | **Added** `wire:navigate`, PWA meta, theme toggle |
| 32 | `resources/views/layouts/guest.blade.php` | +18 / −6 | Guest layout updates |
| 33 | `resources/views/layouts/receipt.blade.php` | +12 / −4 | Receipt layout |

---

## 5. Feature Differences

### Live Server (`main-local`) has — GitHub Remote lacks:

| Feature | Status |
|---------|--------|
| **Per-member custom fee (`monthly_fee`)** | ✅ New DB column + UI in AddMember |
| **Per-member custom payment term (`payment_term`)** | ✅ New DB column + UI in AddMember |
| **Unified dues calculation (`MemberService`)** | ✅ Respects custom fee/term per member |
| **Payment `year` / `month` columns** | ✅ New migrations for yearly tracking |
| **PWA support (`silviolleite/laravelpwa`)** | ✅ Icons + manifest present |
| **Dark / Light mode toggle** | ✅ Theme switcher in `app.blade.php` |
| **Livewire `wire:navigate`** | ✅ Enabled for SPA-like navigation |
| **Root `.htaccess` for shared hosting** | ✅ cPanel deployment ready |
| **Bilingual README** | ✅ Bangla + English documentation |

### GitHub Remote has — Live Server lacks:

| Feature | Status |
|---------|--------|
| **CI/CD (`tests.yml`)** | ❌ Removed |
| **Dependabot config** | ❌ Removed |
| **Laravel Pint (`pint.json`)** | ❌ Removed |
| **Screenshots folder** | ❌ Removed |
| **Database seeders & factories** | ❌ Removed |
| **Spatie permission migrations** | ❌ Removed (replaced by Tyro) |

---

## 6. Database Migration Status

| Migration | Applied? | Notes |
|-----------|----------|-------|
| `2025_05_14_000000_add_payment_fields_to_users_table.php` | ❌ **NOT RUN** | Adds `monthly_fee`, `payment_term` to `users` |
| `2025_05_14_000001_add_year_month_to_payments_table.php` | ❌ **NOT RUN** | Adds `year`, `month` to `payments` |
| `2025_05_14_000002_add_fields_to_payments_table.php` | ❌ **NOT RUN** | Additional payment fields |

> ⚠️ **Action required:** Run `php artisan migrate` on the live server to activate the custom fee/term features.

---

## 7. Recommendations

### Immediate (before next deploy)
1. **Run migrations** on live server:
   ```bash
   php artisan migrate
   ```
2. **Verify `main-local` is the canonical branch** — the remote `main` has 59 older commits that are essentially superseded.

### Sync strategy
- **Option A — Force overwrite remote `main`:**
  ```bash
  git checkout main-local
  git push origin main-local:main --force-with-lease
  ```
  *Use if you want the live server code to become the single source of truth.*

- **Option B — Keep `main-local` as a long-lived branch:**
  ```bash
  git checkout main-local
  git push -u origin main-local
  ```
  *Use if you want to preserve remote history and treat `main-local` as the production branch.*

### Cleanup suggestions
- Remove `.zip` build artifacts (`PROJONMO.zip`, `app.zip`, `projonmo.zip`) from git tracking — add to `.gitignore`.
- Remove `task.md` and `GIT_COMPARISON_REPORT.md` from tracking if they are ephemeral.
- Consider restoring `.github/workflows/tests.yml` if you want CI on PRs.

---

*Report generated by comparing `origin/main` (FETCH_HEAD) against local `HEAD` on `main-local`.*
