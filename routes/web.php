<?php

use App\Livewire\Auth\Register;
use App\Livewire\Auth\PendingStatus;
use App\Livewire\VerifyMember;
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
use App\Livewire\Admin\ProfileEdit as AdminProfileEdit;
use App\Livewire\Admin\MemberCertificate;
use App\Livewire\DocumentList;
use App\Livewire\DocumentView;
use App\Livewire\Admin\SubmitDocument;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Member\PaymentReceiptController;

Route::get('/', function () {
    if (Auth::check()) {
        // Use role helper to redirect to appropriate dashboard
        // Redirect everyone to member profile initially
        return redirect()->route('member.profile');
    }
    return redirect()->route('tyro-login.login');
})->name('home');

Route::get('/register', Register::class)->name('register');
Route::get('/pending-status/{phone?}', PendingStatus::class)->name('pending-status');

// Dynamic PWA manifest — reads name/short-name from the organization settings
// so that when admin changes the org name/logo the installed PWA identity
// stays aligned. Any icon file that doesn't exist on disk is filtered out.
Route::get('/manifest.json', function () {
    $name = org_name();
    $shortNameDefault = mb_substr($name, 0, 12);
    $shortName = (string) org_settings()->get('organization_short_name', $shortNameDefault);

    $logoPath = org_logo_path();
    $iconSizes = ['72x72', '96x96', '128x128', '144x144', '152x152', '192x192', '384x384', '512x512'];
    $icons = [];
    foreach ($iconSizes as $size) {
        $relPath = "/images/icons/icon-{$size}.png";
        if (file_exists(public_path($relPath))) {
            $icons[] = [
                'src'     => $relPath,
                'sizes'   => $size,
                'type'    => 'image/png',
                'purpose' => 'any',
            ];
            if (in_array($size, ['192x192', '512x512'], true)) {
                $icons[] = [
                    'src'     => $relPath,
                    'sizes'   => $size,
                    'type'    => 'image/png',
                    'purpose' => 'maskable',
                ];
            }
        }
    }

    // Prefer the uploaded org logo as the primary icon (browsers will still
    // fall back to the PNGs above for install prompts that need specific sizes).
    if ($logoPath && file_exists(storage_path('app/public/' . $logoPath))) {
        array_unshift($icons, [
            'src'     => asset('storage/' . $logoPath),
            'sizes'   => 'any',
            'type'    => 'image/png',
            'purpose' => 'any',
        ]);
    }

    $manifest = [
        'name'             => $name,
        'short_name'       => $shortName,
        'description'      => $name . ' - সদস্য ব্যবস্থাপনা সিস্টেম',
        'start_url'        => '/',
        'display'          => 'standalone',
        'background_color' => '#ffffff',
        'theme_color'      => '#3b82f6',
        'orientation'      => 'portrait-primary',
        'icons'            => $icons,
    ];

    return response()->json($manifest, 200, [
        'Content-Type'  => 'application/manifest+json',
        'Cache-Control' => 'public, max-age=300',
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
})->name('pwa.manifest');

// Public membership verification — opened when someone scans a member's QR code.
// No auth required so anyone (shop, bank, police, etc.) can verify on the spot.
Route::get('/verify/{token}', VerifyMember::class)
    ->where('token', '[a-fA-F0-9]{32}')
    ->name('member.verify');

Route::middleware(['auth', 'roles:member,accountant,admin'])->prefix('member')->name('member.')->group(function () {
    Route::get('/dashboard', MemberDashboard::class)->name('dashboard');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/profile/edit', ProfileEdit::class)->name('profile.edit');
    Route::get('/payment', SubmitPayment::class)->name('payment');
    Route::get('/history', PaymentHistory::class)->name('history');
    Route::get('/bank-deposits', \App\Livewire\Member\BankDeposits::class)->name('bank-deposits');
    Route::get('/notifications', Notifications::class)->name('notifications');
    Route::get('/payments/{paymentId}/receipt-preview', [PaymentReceiptController::class, 'preview'])
        ->name('payments.receipt.preview');
    Route::get('/payments/{paymentId}/receipt-download', [PaymentReceiptController::class, 'download'])
        ->name('payments.receipt.download');
});

// Document routes (accessible to all authenticated users)
Route::middleware(['auth'])->group(function () {
    Route::get('/documents', DocumentList::class)->name('documents.list');
    Route::get('/documents/{id}', DocumentView::class)->name('documents.view');
});

Route::middleware(['auth', 'role:accountant'])->prefix('accountant')->name('accountant.')->group(function () {
    Route::get('/dashboard', AccountantDashboard::class)->name('dashboard');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/profile/edit', ProfileEdit::class)->name('profile.edit');
    Route::get('/transactions', AccountantTransactions::class)->name('transactions');
    Route::get('/bank-deposits', \App\Livewire\Member\BankDeposits::class)->name('bank-deposits');
    Route::get('/approve/{payment}', function() { return 'Approve page coming soon'; })->name('approve');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/profile/edit', AdminProfileEdit::class)->name('profile.edit');
    Route::get('/pending-registrations', PendingRegistrations::class)->name('pending-registrations');
    Route::get('/members', MemberList::class)->name('members');
    Route::get('/members/add', AddMember::class)->name('members.add');
    Route::get('/members/view/{memberId}', \App\Livewire\Admin\ViewMemberProfile::class)->name('members.view');
    Route::get('/member-certificate/{memberId}', MemberCertificate::class)->name('member-certificate');
    Route::get('/transactions', Transactions::class)->name('transactions');
    Route::get('/bank-deposits', \App\Livewire\Member\BankDeposits::class)->name('bank-deposits');
    Route::get('/roles', RoleManagement::class)->name('roles');
    Route::get('/privileges', PrivilegeManagement::class)->name('privileges');
    Route::get('/user-roles', UserRoleAssignment::class)->name('user-roles');
    Route::get('/settings', Settings::class)->name('settings');
    Route::get('/roadmap', \App\Livewire\Admin\Roadmap::class)->name('roadmap');
    Route::get('/documents/submit', SubmitDocument::class)->name('documents.submit');
});
