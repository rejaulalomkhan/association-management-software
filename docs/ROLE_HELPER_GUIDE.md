# Role Helper Usage Guide

## Overview
এই helper system Tyro package এর সাথে কাজ করে এবং role-based routing সহজ করে। এটি dynamic role detection করে এবং সব custom roles support করে।

## Available Functions

### 1. `user_role()`
বর্তমান user এর primary role return করে।

```php
$role = user_role(); // Returns: 'admin', 'accountant', 'member', or custom role
```

### 2. `role_route($name, $parameters = [], $absolute = true)`
User এর role অনুযায়ী automatically route generate করে।

```php
// Instead of:
route('admin.dashboard')  // For admin
route('member.dashboard') // For member

// Use:
role_route('dashboard') // Automatically adds role prefix
```

**Examples:**
```php
// Simple route
<a href="{{ role_route('dashboard') }}">Dashboard</a>

// With parameters
<a href="{{ role_route('members.show', ['id' => $user->id]) }}">View Member</a>

// In controller redirect
return redirect(role_route('profile'));
```

### 3. `user_roles()`
User এর সব assigned roles এর array return করে।

```php
$roles = user_roles(); // Returns: ['admin', 'accountant']
```

## Usage in Blade Templates

### Profile Links
```blade
<!-- Edit Profile Button -->
<a href="{{ role_route('profile.edit') }}">প্রোফাইল সম্পাদনা</a>

<!-- Back to Profile -->
<a href="{{ role_route('profile') }}">প্রোফাইলে ফিরে যান</a>

<!-- Dashboard Link -->
<a href="{{ role_route('dashboard') }}">ড্যাশবোর্ড</a>
```

### Navigation Menu
```blade
<nav>
    <a href="{{ role_route('dashboard') }}">Dashboard</a>
    <a href="{{ role_route('profile') }}">Profile</a>
    
    @if(auth()->user()->hasRole('admin'))
        <a href="{{ role_route('settings') }}">Settings</a>
    @endif
</nav>
```

## Usage in Controllers

### Redirects
```php
// After saving profile
public function updateProfile()
{
    // ... save logic ...
    
    return redirect(role_route('profile'));
}

// After login
public function login()
{
    // ... authentication logic ...
    
    return redirect(role_route('dashboard'));
}
```

### Generating URLs
```php
// In controller method
public function show()
{
    $profileUrl = role_route('profile');
    $dashboardUrl = role_route('dashboard');
    
    return view('page', compact('profileUrl', 'dashboardUrl'));
}
```

## Integration with Tyro Package

এই helper Tyro এর `hasRole()` method ব্যবহার করে, তাই:

1. **সব Tyro roles automatically support হয়**
   - Admin panel থেকে তৈরি custom roles
   - Default roles (admin, accountant, member)

2. **Role priority maintained থাকে:**
   - Admin (highest)
   - Accountant
   - Member
   - Custom roles (fallback)

3. **Tyro এর সব features available:**
   ```php
   // Still use Tyro methods for role checking
   auth()->user()->hasRole('admin')
   auth()->user()->hasPrivilege('manage_users')
   ```

## Adding Custom Role Routes

যদি নতুন role তৈরি করেন (যেমন 'moderator'), শুধু routes যোগ করুন:

```php
Route::middleware(['auth', 'role:moderator'])
    ->prefix('moderator')
    ->name('moderator.')
    ->group(function () {
        Route::get('/dashboard', ModeratorDashboard::class)->name('dashboard');
        Route::get('/profile', Profile::class)->name('profile');
        Route::get('/profile/edit', ProfileEdit::class)->name('profile.edit');
    });
```

Helper automatically কাজ করবে! 🎉

## Benefits

✅ **Less Code:** Duplicate role checking code eliminate  
✅ **Maintainable:** Centralized role logic  
✅ **Flexible:** সব custom roles automatically support  
✅ **Type Safe:** Single source of truth for role names  
✅ **Clean URLs:** Consistent URL patterns  

## Example Conversion

**Before:**
```php
@php
    $userRole = 'member';
    if(auth()->user()->hasRole('admin')) {
        $userRole = 'admin';
    } elseif(auth()->user()->hasRole('accountant')) {
        $userRole = 'accountant';
    }
@endphp
<a href="{{ route($userRole . '.profile') }}">Profile</a>
```

**After:**
```php
<a href="{{ role_route('profile') }}">Profile</a>
```

훨씬 clean! 🚀
