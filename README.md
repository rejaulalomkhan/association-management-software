# Projonmo Unnayan Mission - Association Management System

A comprehensive web-based management system for the Projonmo Unnayan Mission organization, built with Laravel 12, Livewire 3, and Tailwind CSS v4.

## Features

### 🔐 Authentication & Authorization
- Custom registration system with terms & conditions
- Phone number-based authentication
- Role-based access control (Admin, Accountant, Member)
- Pending registration approval workflow
- Powered by [Tyro](https://github.com/hasinhayder/tyro) and [Tyro Login](https://github.com/hasinhayder/tyro-login)

### 👥 Member Management
- Member registration with detailed profile information
- Profile picture upload
- Membership ID generation
- Member status tracking (Active, Inactive, Pending)
- Member certificate generation (PDF)
- Member list with search and filtering

### 💰 Payment & Transactions
- Monthly payment submission by members
- Payment approval workflow
- Payment history tracking
- Transaction receipts (PDF download)
- Bank deposit management
- Payment method tracking (bKash, Nagad, Rocket, Bank Transfer)

### 📊 Dashboard & Reports
- Role-specific dashboards (Admin, Accountant, Member)
- Payment statistics and summaries
- Due payment tracking
- Transaction reports with filtering
- Export reports to PDF

### 📄 Document Management
- Document upload and categorization
- Document viewing and download
- Document list with search

### 🎨 UI/UX Features
- **Dark Mode Support** - Toggle between light and dark themes
- Responsive design (Mobile, Tablet, Desktop)
- Bengali language interface
- PWA (Progressive Web App) support
- Real-time notifications
- Toast notifications for user feedback

### 🔔 Notifications
- Payment approval notifications
- Payment rejection notifications
- Custom notification system
- Real-time notification badge

## Tech Stack

- **Backend**: Laravel 12
- **Frontend**: Livewire 3, Alpine.js
- **Styling**: Tailwind CSS v4
- **Database**: MySQL
- **PDF Generation**: mPDF
- **Authentication**: Tyro Login Package
- **Authorization**: Tyro Package
- **PWA**: Laravel PWA Package

## Requirements

- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL 5.7 or higher

## Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd projonmo
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database**
   
   Edit `.env` file and set your database credentials:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=projonmo
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed database (optional)**
   ```bash
   php artisan db:seed
   ```

8. **Create storage link**
   ```bash
   php artisan storage:link
   ```

9. **Build assets**
   ```bash
   npm run build
   ```

10. **Start development server**
    ```bash
    php artisan serve
    ```
    
    In a separate terminal:
    ```bash
    npm run dev
    ```

## Configuration

### Organization Settings

Configure your organization details in the Admin Settings page:
- Organization Name
- Organization Logo
- Established Year
- Monthly Payment Amount
- Payment Methods

### Dark Mode

The application supports dark mode with theme persistence. Users can toggle between light and dark themes from the profile dropdown menu. The theme preference is stored in localStorage and syncs with the login page.

**Technical Implementation:**
- Tailwind CSS v4 with `@variant dark (.dark &);` directive
- JavaScript theme management functions
- localStorage key: `tyro-login-theme`

### PWA Configuration

The application is PWA-enabled. Users can install it on their devices for a native app-like experience.

## Deployment

### Production Build

1. **Build assets for production**
   ```bash
   npm run build
   ```

2. **Optimize Laravel**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

3. **Set proper permissions**
   ```bash
   chmod -R 775 storage bootstrap/cache
   ```

### cPanel Deployment

1. Upload all files to your cPanel public_html directory
2. Run composer install on the server:
   ```bash
   composer install --optimize-autoloader --no-dev
   ```
3. Clear caches:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   php artisan route:clear
   php artisan view:clear
   ```
4. Set up environment variables in `.env`
5. Run migrations:
   ```bash
   php artisan migrate --force
   ```

## Default Roles

The system comes with three default roles:

1. **Admin** - Full system access
2. **Accountant** - Payment and transaction management
3. **Member** - Limited access to personal profile and payments

## File Structure

```
├── app/
│   ├── Helpers/          # Helper functions
│   ├── Livewire/         # Livewire components
│   ├── Models/           # Eloquent models
│   └── Services/         # Business logic services
├── resources/
│   ├── css/              # Stylesheets
│   ├── js/               # JavaScript files
│   └── views/            # Blade templates
├── public/
│   ├── fonts/            # Bengali fonts
│   └── storage/          # Public storage link
└── database/
    ├── migrations/       # Database migrations
    └── seeders/          # Database seeders
```

## Troubleshooting

### Dark Mode Not Working

If dark mode is not working after deployment:

1. Ensure `@variant dark (.dark &);` is in `resources/css/app.css`
2. Rebuild assets: `npm run build`
3. Clear browser cache (Ctrl+Shift+R)
4. Check that the CSS file size increased after rebuild

### PDF Download Errors

If PDF downloads fail with "Class not found" errors:

1. Run `composer install` on the server
2. Ensure mPDF package is installed: `composer require mpdf/mpdf`
3. Clear caches

### Permission Issues

If you encounter permission errors:

```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## Support

For issues and questions, please contact the development team.

## License

This project is proprietary software developed for Projonmo Unnayan Mission.

---

**Developed with ❤️ using Laravel & Livewire**
