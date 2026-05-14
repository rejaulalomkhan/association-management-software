# Association Management Software

<p align="center"><strong>সমার্থনের হিসাব ব্যবস্থাপনা সফটোয়ার</strong></p>

<p align="center">
A complete <b>Laravel 12 + Livewire</b> based association/organization management system with multi-role support, payment tracking, receipt generation, and member management — fully localized in <b>Bangla (বাংলা)</b>.
</p>

---

## সার্ভিত | Features

### ভূমিকা | Role Management
- <b>Admin</b> — Full control: members, payments, settings, reports
- <b>Accountant</b> — Payment approval, transaction management
- <b>Member</b> — Profile, payment submission, history, receipts
- Powered by <b>Tyro</b> role system

### পেমেন্ট ব্যবস্থাপনা | Payment System
- <b>Monthly & Yearly</b> payment terms (organization-wide or per-member)
- <b>Custom monthly fee</b> per member (override default)
- Payment types: <b>Current, Overdue, Advance</b>
- Multiple payment methods (Cash, Bank, bKash, Nagad, etc.)
- Payment proof upload (screenshot/image)
- Admin/Accountant approval workflow
- Automatic receipt generation (PDF)

### ড্যাশবোর্ড | Dashboard
- Real-time statistics (members, payments, collection rate)
- Monthly/Yearly filter support
- Bank deposit tracking
- Unpaid member list with term-aware logic

### সদস্য প্রোফাইল | Member Profile
- Personal info, contact, address
- Payment history with year filter
- Monthly payment calendar view
- QR code based verification certificate
- Profile photo upload

### সেটিঙ্স | Settings
- Organization name, logo, address
- Established year & month
- Default monthly fee & payment term
- Bank account details
- Payment methods management
- Registration terms & conditions
- Dark/Light mode toggle

### পিডিএ | PWA Support
- Installable as mobile app
- Offline-ready capabilities
- Push notification ready

---

## টেক স্টেক | Tech Stack

| Technology | Version | Purpose |
|------------|---------|---------|
| **Laravel** | 12.x | Backend framework |
| **Livewire** | 3.x | Reactive UI components |
| **Tailwind CSS** | 3.x | Styling |
| **Alpine.js** | 3.x | Frontend interactions |
| **Tyro** | ^1.1 | Role-based access control |
| **Tyro Login** | ^1.3 | Authentication (Email/Phone) |
| **DOMPDF** | ^3.1 | PDF receipt generation |
| **Laravel PWA** | ^2.0 | Progressive Web App |

---

## ইনস্টল করুন | Installation

### Requirements
- PHP >= 8.2
- MySQL / MariaDB / SQLite
- Composer
- Node.js & NPM (for asset building)

### Step 1: Clone & Install

```bash
git clone https://github.com/rejaulalomkhan/association-management-software.git
cd association-management-software
composer install
npm install
npm run build
```

### Step 2: Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` and configure your database:

```env
APP_NAME="Your Organization"
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=root
DB_PASSWORD=your_password
```

### Step 3: Database Setup

```bash
php artisan migrate
php artisan db:seed
```

### Step 4: Storage Link

```bash
php artisan storage:link
```

### Step 5: Run

```bash
php artisan serve
```

Visit `http://localhost:8000`

---

## ডিফল্ট লগিন | Default Login

After seeding, default admin credentials:

| Field | Value |
|-------|-------|
| **Phone** | `01700000000` |
| **Password** | `password` |

> প্রোডাকশন সেটিংস থেকে প্রথমে ব্যবহার করুন। | Change password from settings immediately.

---

## প্রোজেক্ট গঠন | Project Structure

```
association-management-software/
├── app/
│   ├── Enums/
│   │   └── PaymentTerm.php          # monthly | yearly
│   ├── Helpers/
│   │   └── helpers.php                # org_name(), org_monthly_fee(), etc.
│   ├── Livewire/
│   │   ├── Admin/                    # Dashboard, Settings, MemberList, etc.
│   │   ├── Member/                   # Profile, SubmitPayment, PaymentHistory
│   │   └── Auth/                     # Register, Login (via Tyro)
│   ├── Models/
│   │   ├── User.php                  # effectiveMonthlyFee(), effectivePaymentTerm()
│   │   ├── Payment.php               # term-aware payment records
│   │   └── ...
│   └── Services/
│       ├── MemberService.php         # Dues calculation (monthly/yearly)
│       ├── SettingsService.php         # Dynamic organization settings
│       ├── TransactionService.php      # Payment CRUD & stats
│       └── PdfService.php             # Receipt generation
├── database/
│   ├── migrations/
│   │   └── ...add_payment_fields_to_users_table.php
│   └── seeders/
├── resources/
│   └── views/
│       └── livewire/
│           ├── admin/
│           ├── member/
│           └── ...
├── routes/
│   └── web.php                        # Role-based route groups
└── config/
    ├── tyro-login.php                  # Auth config
    └── livewire.php                     # Livewire settings
```

---

## লাইসেন্স | License

This project is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## ধন্যবাদ | Acknowledgements

- [Laravel](https://laravel.com) — The PHP Framework for Web Artisans
- [Livewire](https://livewire.laravel.com) — Reactive UI for Laravel
- [Tailwind CSS](https://tailwindcss.com) — Utility-first CSS framework
- [Tyro](https://github.com/hasinhayder/tyro) — Role management for Laravel

---

<p align="center">
Built with ❤️ by <a href="https://github.com/rejaulalomkhan">rejaulalomkhan</a>
</p>
