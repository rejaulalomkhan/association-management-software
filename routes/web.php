<?php

use App\Livewire\Auth\Register;

use App\Livewire\Member\Dashboard as MemberDashboard;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/register', Register::class)->name('register');

use App\Livewire\Member\PaymentHistory;

Route::middleware(['auth', 'role:member'])->prefix('member')->name('member.')->group(function () {
    Route::get('/dashboard', MemberDashboard::class)->name('dashboard');
    Route::get('/payment', SubmitPayment::class)->name('payment');
    Route::get('/history', PaymentHistory::class)->name('history');
});
