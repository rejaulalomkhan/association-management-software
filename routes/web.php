<?php

use App\Livewire\Auth\Register;
use App\Livewire\Member\Dashboard as MemberDashboard;
use App\Livewire\Member\EditProfile;
use App\Livewire\Member\Profile;
use App\Livewire\Member\ProfileEdit;
use App\Livewire\Member\SubmitPayment;
use App\Livewire\Member\PaymentHistory;
use App\Livewire\Member\Notifications;
use App\Livewire\Accountant\Dashboard as AccountantDashboard;
use App\Livewire\Accountant\Transactions as AccountantTransactions;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Settings;
use App\Livewire\Admin\PendingRegistrations;
use App\Livewire\Admin\MemberList;
use App\Livewire\Admin\AddMember;
use App\Livewire\Admin\Transactions;
use App\Livewire\Admin\RoleManagement;
use App\Livewire\Admin\PrivilegeManagement;
use App\Livewire\Admin\UserRoleAssignment;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Member\PaymentReceiptController;

Route::get('/', function () {
    if (Auth::check()) {
        // Use role helper to redirect to appropriate dashboard
        return redirect(role_route('dashboard'));
    }
    return redirect()->route('tyro-login.login');
})->name('home');

Route::get('/register', Register::class)->name('register');

Route::middleware(['auth', 'role:member'])->prefix('member')->name('member.')->group(function () {
    Route::get('/dashboard', MemberDashboard::class)->name('dashboard');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/profile/edit', ProfileEdit::class)->name('profile.edit');
    Route::get('/payment', SubmitPayment::class)->name('payment');
    Route::get('/history', PaymentHistory::class)->name('history');
    Route::get('/notifications', Notifications::class)->name('notifications');
    Route::get('/payments/{payment}/receipt-preview', [PaymentReceiptController::class, 'preview'])
        ->name('payments.receipt.preview');
});

Route::middleware(['auth', 'role:accountant'])->prefix('accountant')->name('accountant.')->group(function () {
    Route::get('/dashboard', AccountantDashboard::class)->name('dashboard');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/profile/edit', ProfileEdit::class)->name('profile.edit');
    Route::get('/transactions', AccountantTransactions::class)->name('transactions');
    Route::get('/approve/{payment}', function() { return 'Approve page coming soon'; })->name('approve');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/profile/edit', ProfileEdit::class)->name('profile.edit');
    Route::get('/pending-registrations', PendingRegistrations::class)->name('pending-registrations');
    Route::get('/members', MemberList::class)->name('members');
    Route::get('/members/add', AddMember::class)->name('members.add');
    Route::get('/transactions', Transactions::class)->name('transactions');
    Route::get('/roles', RoleManagement::class)->name('roles');
    Route::get('/privileges', PrivilegeManagement::class)->name('privileges');
    Route::get('/user-roles', UserRoleAssignment::class)->name('user-roles');
    Route::get('/settings', Settings::class)->name('settings');
});
