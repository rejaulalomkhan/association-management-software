<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Payment model for storing member payment records.
 *
 * @property int $user_id Member who made the payment
 * @property string $transaction_id Unique transaction identifier
 * @property string $month Month name (e.g., 'January')
 * @property int $year Year
 * @property string $term Payment term (monthly/yearly)
 * @property float $amount Payment amount
 * @property string $method Payment method name
 * @property int|null $payment_method_id Payment method ID
 * @property string|null $description Payment description
 * @property string|null $proof_path Path to payment proof file
 * @property string $status Payment status (pending/approved/rejected)
 * @property string|null $admin_note Admin note for approval/rejection
 * @property \Carbon\Carbon|null $processed_at When payment was processed
 * @property int|null $processed_by Admin who processed the payment
 */
class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'transaction_id',
        'month',
        'year',
        'term',
        'amount',
        'method',
        'payment_method_id',
        'description',
        'proof_path',
        'status',
        'admin_note',
        'processed_at',
        'processed_by',
    ];

    protected $attributes = [
        'term' => \App\Enums\PaymentTerm::MONTHLY,
    ];

    protected $casts = [
        'processed_at' => 'datetime',
    ];

    /**
     * Scope: only monthly payment rows (current-style per-month).
     */
    public function scopeMonthlyTerm($query)
    {
        return $query->where('term', \App\Enums\PaymentTerm::MONTHLY);
    }

    /**
     * Scope: only yearly-lump payment rows.
     */
    public function scopeYearlyTerm($query)
    {
        return $query->where('term', \App\Enums\PaymentTerm::YEARLY);
    }

    /**
     * Get the user who made this payment.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the admin/accountant who processed this payment.
     */
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    /**
     * Get the payment method.
     */
    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    /**
     * Scope to get payments for a specific month and year.
     */
    public function scopeForMonth($query, string $month, int $year)
    {
        return $query->where('month', $month)->where('year', $year);
    }

    /**
     * Scope to get approved payments.
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope to get pending payments.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope to get rejected payments.
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Get formatted month-year string.
     */
    public function getMonthYearAttribute(): string
    {
        return $this->month . ' ' . $this->year;
    }
}

