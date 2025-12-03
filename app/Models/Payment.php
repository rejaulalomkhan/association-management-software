<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'transaction_id',
        'month',
        'year',
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

    protected $casts = [
        'processed_at' => 'datetime',
    ];

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

