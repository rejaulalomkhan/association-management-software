# Task List: Projonmo Unnayan Mission

## Project Initialization
- [x] Move requirement files to `docs/` folder
- [x] Install Laravel 12 (Latest) - v12.40.2
- [x] Configure [.env](file:///i:/ar/laragon/projonmo/.env) (Database: `projonmo`, User: `root`)
- [x] Install Tyro: `composer require hasinhayder/tyro`
- [x] Run Tyro installer: `php artisan tyro:install`
- [x] Install Tyro-Login: `composer require hasinhayder/tyro-login`
- [x] Run Tyro-Login installer: `php artisan tyro-login:install`
- [x] Install Livewire: `composer require livewire/livewire`
- [x] Install `dompdf`: `composer require barryvdh/laravel-dompdf`
- [x] Setup Tailwind CSS & Alpine.js (Manual Setup)

## Database & Models
- [x] Modify `users` migration (add custom fields)
- [x] Create payments migration and model
- [x] Create settings migration and model
- [x] Add membership_id to users table
- [x] Create payment_methods table
- [x] Update payments table structure (month, year, admin_note)
- [x] Create notifications table
- [x] Run migrations
- [x] Create roles: `admin`, `accountant`, `member`
- [x] Seed default settings
- [x] Seed payment methods (Hand Cash, bKash, Nagad, Rocket, Bank, Upay)
- [x] Create SettingsService, MemberService, TransactionService

## Authentication & Registration
- [x] Publish Tyro-Login views
- [x] Extend registration form with custom fields
- [x] Update registration logic to handle custom fields
- [x] Configure login to use `phone` instead of `email`

## Layout & UI
- [x] Create [layouts/app.blade.php](file:///i:/ar/laragon/projonmo/resources/views/layouts/app.blade.php) with Tailwind
- [x] Create [components/sidebar.blade.php](file:///i:/ar/laragon/projonmo/resources/views/components/sidebar.blade.php) (Desktop)
- [x] Create [components/bottom-nav.blade.php](file:///i:/ar/laragon/projonmo/resources/views/components/bottom-nav.blade.php) (Mobile)
- [x] Create [components/toast.blade.php](file:///i:/ar/laragon/projonmo/resources/views/components/toast.blade.php) (Notifications)
- [x] Configure responsive navigation switching

## Admin Panel
- [x] `Admin\Settings` - Organization settings management
  - [x] Organization name, logo, address, phone
  - [x] Monthly fee configuration
  - [x] Organization start month
  - [x] Payment methods management
- [x] `Admin\PendingRegistrations` - Approve/reject members
  - [x] View pending members with details
  - [x] Approve members (auto-generate membership ID)
  - [x] Reject members with reason
- [x] `Admin\MemberList` - Member management
  - [x] List all active members with photos
  - [x] Filter by status
  - [x] View member profile (single page)
  - [x] View member transactions
- [x] `Admin\Dashboard` - Stats, charts, filters
  - [x] Summary cards (total paid, unpaid, monthly collection)
  - [x] Two tables: Paid Members | Unpaid Members
  - [x] Month/Year filters
  - [x] Current month statistics
- [ ] `Admin\Transactions` - All transactions management
  - [ ] Filter by member, month, year, status
  - [ ] Approve/reject payments
  - [ ] Add admin notes
  - [ ] Export reports

## Accountant Panel
- [x] `Accountant\Dashboard` - Pending payments overview
  - [x] List pending payments with member details
  - [x] Quick approve/reject actions
  - [x] Monthly summary cards
- [ ] `Accountant\Transactions` - Transaction management
  - [ ] View all transactions
  - [ ] Filter by month, year, status
  - [ ] Process payments
  - [ ] Add processing notes

## Member Panel
- [x] `Member\Dashboard` - Finance dashboard (App-like UI)
  - [x] Total balance display
  - [x] Outstanding dues calculation
  - [x] Current month payment notification
  - [x] Summary cards (paid, unpaid, pending)
  - [x] Quick payment button
- [x] `Member\EditProfile` - Profile management
  - [x] Update personal information
  - [x] Upload profile photo
  - [x] View membership ID and status
- [x] `Member\SubmitPayment` - Payment submission
  - [x] Select month/year from unpaid list
  - [x] Choose payment method
  - [x] Upload payment proof
  - [x] Add description
- [x] `Member\PaymentHistory` - Transaction history
  - [x] List all transactions with status
  - [x] Filter by month, year, status
  - [x] View admin notes
  - [x] Download PDF receipt

## Utilities & Helpers
- [x] Membership ID auto-generation (PUM-25-0001)
- [x] Month/Year helpers with Bangla support
- [x] Outstanding dues calculator
- [x] Notification system for payment updates
- [ ] PDF receipt generator

## Bangla Localization
- [x] Create lang/bn directory
- [x] Translate all UI strings
- [x] Bangla month names
- [x] Bangla number formatting
- [x] Currency symbol (৳)

## Final Polish
- [ ] PWA Configuration
- [ ] Testing & Verification
- [ ] Code optimization and cleanup
- [ ] Deploy to Laragon
