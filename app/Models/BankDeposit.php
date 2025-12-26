<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankDeposit extends Model
{
    protected $fillable = [
        'transaction_type',
        'amount',
        'balance_after',
        'month',
        'year',
        'bank_message_screenshot',
        'bank_receipt',
        'deposited_by',
        'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'balance_after' => 'decimal:2',
        'month' => 'integer',
        'year' => 'integer',
    ];

    /**
     * Relationship: User who made the deposit/withdrawal
     */
    public function depositor()
    {
        return $this->belongsTo(User::class, 'deposited_by');
    }

    /**
     * Scope: Filter by year
     */
    public function scopeByYear($query, $year)
    {
        return $query->where('year', $year);
    }

    /**
     * Scope: Filter by month
     */
    public function scopeByMonth($query, $month)
    {
        return $query->where('month', $month);
    }

    /**
     * Scope: Current year only
     */
    public function scopeCurrentYear($query)
    {
        return $query->where('year', now()->year);
    }

    /**
     * Scope: Order by newest first
     */
    public function scopeNewest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Get total bank balance (latest balance_after)
     */
    public static function getTotalBalance()
    {
        $latest = self::orderBy('created_at', 'desc')->first();
        return $latest ? $latest->balance_after : 0;
    }

    /**
     * Get yearly total deposits
     */
    public static function getYearlyTotal($year)
    {
        return self::where('year', $year)
            ->where('transaction_type', 'deposit')
            ->sum('amount');
    }

    /**
     * Get yearly total withdrawals
     */
    public static function getYearlyWithdrawals($year)
    {
        return self::where('year', $year)
            ->where('transaction_type', 'withdrawal')
            ->sum('amount');
    }

    /**
     * Calculate balance after transaction
     * - deposit and profit: add to balance
     * - withdrawal and deduction: subtract from balance
     */
    public static function calculateBalanceAfter($amount, $transactionType)
    {
        $currentBalance = self::getTotalBalance();
        
        if (in_array($transactionType, ['deposit', 'profit'])) {
            return $currentBalance + $amount;
        } else {
            return $currentBalance - $amount;
        }
    }

    /**
     * Accessor: Get full URL for bank message screenshot
     */
    public function getBankMessageUrlAttribute()
    {
        return $this->bank_message_screenshot 
            ? asset('storage/' . $this->bank_message_screenshot) 
            : null;
    }

    /**
     * Accessor: Get full URL for bank receipt
     */
    public function getBankReceiptUrlAttribute()
    {
        return $this->bank_receipt 
            ? asset('storage/' . $this->bank_receipt) 
            : null;
    }

    /**
     * Get month name in Bengali
     */
    public function getMonthNameAttribute()
    {
        $months = [
            1 => 'জানুয়ারি', 2 => 'ফেব্রুয়ারি', 3 => 'মার্চ', 4 => 'এপ্রিল',
            5 => 'মে', 6 => 'জুন', 7 => 'জুলাই', 8 => 'আগস্ট',
            9 => 'সেপ্টেম্বর', 10 => 'অক্টোবর', 11 => 'নভেম্বর', 12 => 'ডিসেম্বর'
        ];
        
        return $months[$this->month] ?? '';
    }
}
