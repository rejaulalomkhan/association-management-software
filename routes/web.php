<?php

use App\Livewire\Auth\Register;
use App\Livewire\Member\Dashboard as MemberDashboard;
use App\Livewire\Member\EditProfile;
use App\Livewire\Member\SubmitPayment;
use App\Livewire\Member\PaymentHistory;
use App\Livewire\Accountant\Dashboard as AccountantDashboard;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Settings;
use App\Livewire\Admin\PendingRegistrations;
use App\Livewire\Admin\MemberList;
use App\Livewire\Admin\AddMember;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('accountant')) {
            return redirect()->route('accountant.dashboard');
        } elseif ($user->hasRole('member')) {
            return redirect()->route('member.dashboard');
        }
    }
    return redirect()->route('tyro-login.login');
})->name('home');

Route::get('/register', Register::class)->name('register');

Route::middleware(['auth', 'role:member'])->prefix('member')->name('member.')->group(function () {
    Route::get('/dashboard', MemberDashboard::class)->name('dashboard');
    Route::get('/profile/edit', EditProfile::class)->name('profile.edit');
    Route::get('/payment', SubmitPayment::class)->name('payment');
    Route::get('/history', PaymentHistory::class)->name('history');
});

Route::middleware(['auth', 'role:accountant'])->prefix('accountant')->name('accountant.')->group(function () {
    Route::get('/dashboard', AccountantDashboard::class)->name('dashboard');
    Route::get('/approve/{payment}', function() { return 'Approve page coming soon'; })->name('approve');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
    Route::get('/pending-registrations', PendingRegistrations::class)->name('pending-registrations');
    Route::get('/members', MemberList::class)->name('members');
    Route::get('/members/add', AddMember::class)->name('members.add');
    Route::get('/settings', Settings::class)->name('settings');
});
