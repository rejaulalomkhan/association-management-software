<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use HasinHayder\Tyro\Concerns\HasTyroRoles;



class User extends Authenticatable
{
    use HasApiTokens, HasTyroRoles;


    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'membership_id',
        'verification_token',
        'father_name',
        'dob',
        'permanent_address',
        'present_address',
        'blood_group',
        'profession',
        'religion',
        'nationality',
        'position',
        'monthly_fee',
        'payment_term',
        'profile_pic',
        'status',
        'joined_at',
    ];

    /**
     * Resolve the monthly fee that actually applies to this member.
     *
     * Priority:
     *   1. The per-member override stored on `users.monthly_fee` (if > 0)
     *   2. The organization-wide default from `settings.monthly_fee`
     *
     * This is the single source of truth for dues calculation, payment
     * forms, WhatsApp reminders and receipts – never read settings
     * directly when a specific member is in context.
     */
    public function effectiveMonthlyFee(): float
    {
        $custom = $this->monthly_fee;
        if ($custom !== null && (float) $custom > 0) {
            return (float) $custom;
        }

        return (float) app(\App\Services\SettingsService::class)
            ->getMonthlyFee();
    }

    /**
     * True when this member has a custom fee that differs from default.
     */
    public function hasCustomMonthlyFee(): bool
    {
        return $this->monthly_fee !== null && (float) $this->monthly_fee > 0;
    }

    /**
     * Resolve the payment term for this member.
     *
     * Priority:
     *   1. The per-member override on `users.payment_term`
     *   2. The organization-wide default from `settings.payment_term`
     *   3. Hard fallback: monthly
     */
    public function effectivePaymentTerm(): string
    {
        $custom = \App\Enums\PaymentTerm::coerce($this->payment_term);
        if ($custom !== null) {
            return $custom;
        }

        $settingsValue = \App\Enums\PaymentTerm::coerce(
            (string) app(\App\Services\SettingsService::class)->get('payment_term', \App\Enums\PaymentTerm::MONTHLY)
        );

        return $settingsValue ?? \App\Enums\PaymentTerm::MONTHLY;
    }

    /**
     * True when this member has a payment-term override that differs
     * from the organization-wide setting.
     */
    public function hasCustomPaymentTerm(): bool
    {
        return \App\Enums\PaymentTerm::coerce($this->payment_term) !== null;
    }

    /**
     * Derived amounts — always computed from the unit monthly fee so the
     * admin only has to edit a single number per member.
     */
    public function effectiveYearlyFee(): float
    {
        return $this->effectiveMonthlyFee() * 12;
    }

    /**
     * Fee amount for a single billing period under this member's term.
     * Useful for "৳X per <term>" copy in UI.
     */
    public function effectiveTermFee(): float
    {
        return match ($this->effectivePaymentTerm()) {
            \App\Enums\PaymentTerm::YEARLY => $this->effectiveYearlyFee(),
            default                        => $this->effectiveMonthlyFee(),
        };
    }

    /**
     * Ensure the user has a unique verification token and return it.
     * Safe to call repeatedly – only generates a token if one is missing.
     */
    public function ensureVerificationToken(): string
    {
        if (empty($this->verification_token)) {
            do {
                $token = bin2hex(random_bytes(16)); // 32-char hex, hard to guess
            } while (static::where('verification_token', $token)->exists());

            $this->verification_token = $token;
            $this->save();
        }

        return $this->verification_token;
    }

    /**
     * Public URL that will open this member's verification certificate.
     */
    public function verificationUrl(): ?string
    {
        if (empty($this->verification_token)) {
            return null;
        }

        return route('member.verify', ['token' => $this->verification_token]);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    public function getTotalPaidAmount()
    {
        return $this->payments()->where('status', 'approved')->sum('amount');
    }

    public function getPendingAmount()
    {
        return $this->payments()->where('status', 'pending')->sum('amount');
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function username()
    {
        return config('tyro-login.login_field') == 'phone' ? 'phone' : 'email';
    }

    /**
     * Find the user instance for the given username.
     *
     * @param  string  $username
     * @return \App\Models\User|null
     */
    public function findForPassport($username)
    {
        $field = $this->username();
        return $this->where($field, $username)->first();
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'monthly_fee' => 'decimal:2',
        ];
    }
}
