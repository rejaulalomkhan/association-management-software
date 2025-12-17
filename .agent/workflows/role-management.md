---
description: How to manage roles and privileges using Tyro package
---

# Role & Privilege Management Workflow

This workflow explains how to manage roles and privileges in the application using the Tyro package.

## Understanding the Role System

The application uses **Tyro** for Role-Based Access Control (RBAC). Users are assigned roles, and roles have privileges.

### Default Roles

Tyro provides these default roles:
- `super-admin` - Full system access
- `admin` - Administrative access
- `editor` - Content editing access
- `user` - Basic user access
- `customer` - Customer-specific access

### Current Application Roles

Based on the codebase, the application uses:
- `admin` - Full administrative access
- `member` - Regular member access

## Managing Roles

### 1. View All Roles

```bash
php artisan tyro:roles
```

### 2. View Roles with Their Privileges

```bash
php artisan tyro:roles-with-privileges
```

### 3. Create a New Role

```bash
php artisan tyro:create-role --name="Role Name" --slug="role-slug"
```

**Example:**
```bash
php artisan tyro:create-role --name="Accountant" --slug="accountant"
```

### 4. Assign Role to a User

```bash
php artisan tyro:assign-role --user=USER_ID --role=ROLE_SLUG
```

**Example:**
```bash
php artisan tyro:assign-role --user=5 --role=accountant
```

## Managing Privileges

### 1. Create a New Privilege

```bash
php artisan tyro:add-privilege PRIVILEGE_SLUG --name="Privilege Name"
```

**Example:**
```bash
php artisan tyro:add-privilege payments.approve --name="Approve Payments"
```

### 2. Attach Privilege to a Role

```bash
php artisan tyro:attach-privilege PRIVILEGE_SLUG ROLE_SLUG
```

**Example:**
```bash
php artisan tyro:attach-privilege payments.approve admin
```

### 3. Detach Privilege from a Role

```bash
php artisan tyro:detach-privilege PRIVILEGE_SLUG ROLE_SLUG
```

**Example:**
```bash
php artisan tyro:detach-privilege payments.approve editor
```

### 4. View User's Privileges

```bash
php artisan tyro:user-privileges USER_ID
```

## Recommended Privilege Structure

### Admin Privileges
```bash
php artisan tyro:add-privilege members.manage --name="Manage Members"
php artisan tyro:add-privilege payments.approve --name="Approve Payments"
php artisan tyro:add-privilege payments.reject --name="Reject Payments"
php artisan tyro:add-privilege settings.manage --name="Manage Settings"
php artisan tyro:add-privilege roles.manage --name="Manage Roles"
php artisan tyro:add-privilege deposits.manage --name="Manage Bank Deposits"
```

### Accountant Privileges (if needed)
```bash
php artisan tyro:add-privilege deposits.create --name="Create Bank Deposits"
php artisan tyro:add-privilege deposits.view --name="View Bank Deposits"
php artisan tyro:add-privilege payments.view --name="View Payments"
```

### Member Privileges
```bash
php artisan tyro:add-privilege profile.edit --name="Edit Own Profile"
php artisan tyro:add-privilege payments.submit --name="Submit Payments"
php artisan tyro:add-privilege payments.view-own --name="View Own Payments"
```

## Protecting Routes with Middleware

### Using Role Middleware

In `routes/web.php`:

```php
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');
});
```

### Using Privilege Middleware

```php
Route::middleware(['auth', 'privilege:payments.approve'])->group(function () {
    Route::post('/payments/approve', [PaymentController::class, 'approve']);
});
```

### Using Multiple Roles or Privileges

```php
// Allow multiple roles
Route::middleware(['auth', 'role:admin,accountant'])->group(function () {
    Route::get('/deposits', BankDeposits::class);
});

// Allow multiple privileges
Route::middleware(['auth', 'privilege:payments.approve,payments.reject'])->group(function () {
    Route::get('/payments/manage', ManagePayments::class);
});
```

## Checking Permissions in Blade Templates

### Check User Role

```blade
@hasrole('admin')
    <button>Admin Only Button</button>
@endhasrole

@hasanyrole('admin,accountant')
    <button>Admin or Accountant Button</button>
@endhasanyrole
```

### Check User Privilege

```blade
@hasprivilege('payments.approve')
    <button wire:click="approvePayment">Approve</button>
@endhasprivilege

@hasanyprivilege('payments.approve,payments.reject')
    <div>Payment Actions</div>
@endhasanyprivilege
```

## Checking Permissions in Livewire Components

### In Component Methods

```php
public function approvePayment($paymentId)
{
    // Check if user has privilege
    if (!auth()->user()->hasPrivilege('payments.approve')) {
        session()->flash('error', 'আপনার এই কাজ করার অনুমতি নেই।');
        return;
    }
    
    // Approve payment logic
}
```

### Check Role

```php
if (auth()->user()->hasRole('admin')) {
    // Admin-specific logic
}

if (auth()->user()->hasAnyRole(['admin', 'accountant'])) {
    // Logic for admin or accountant
}
```

## User Management

### 1. Create a New User

```bash
php artisan tyro:create-user
```

### 2. List All Users

```bash
php artisan tyro:users
```

### 3. Suspend a User

```bash
php artisan tyro:suspend-user --user=USER_ID --reason="Reason for suspension"
```

### 4. Unsuspend a User

```bash
php artisan tyro:unsuspend-user --user=USER_ID
```

## Best Practices

1. **Use Privileges for Fine-Grained Control**: Instead of checking roles everywhere, use privileges for specific actions.

2. **Keep Role Names Consistent**: Use lowercase with hyphens (e.g., `super-admin`, `accountant`).

3. **Use Descriptive Privilege Names**: Use dot notation for organization (e.g., `payments.approve`, `members.edit`).

4. **Document Your Privileges**: Maintain a list of all privileges and their purposes.

5. **Test Permissions**: Always test role and privilege assignments before deploying.

6. **Use Middleware**: Protect routes at the routing level rather than checking in every controller method.

## Troubleshooting

### User Can't Access a Route

1. Check if user has the required role:
   ```bash
   php artisan tyro:user-privileges USER_ID
   ```

2. Verify role has the required privilege:
   ```bash
   php artisan tyro:roles-with-privileges
   ```

3. Check middleware on the route in `routes/web.php`

### Privilege Not Working

1. Clear cache:
   ```bash
   php artisan cache:clear
   php artisan config:clear
   ```

2. Verify privilege is attached to role:
   ```bash
   php artisan tyro:roles-with-privileges
   ```

## Quick Reference

| Command | Purpose |
|---------|---------|
| `tyro:roles` | List all roles |
| `tyro:roles-with-privileges` | List roles with their privileges |
| `tyro:create-role` | Create a new role |
| `tyro:assign-role` | Assign role to user |
| `tyro:add-privilege` | Create a new privilege |
| `tyro:attach-privilege` | Attach privilege to role |
| `tyro:detach-privilege` | Remove privilege from role |
| `tyro:user-privileges` | View user's privileges |
| `tyro:users` | List all users |
| `tyro:suspend-user` | Suspend a user |
| `tyro:unsuspend-user` | Unsuspend a user |
