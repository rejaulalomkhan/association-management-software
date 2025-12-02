<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'transaction_id',
        'month_year',
        'amount',
        'method',
        'description',
        'screenshot_path',
        'status',
        'submitted_at',
        'processed_at',
        'processed_by',
    ];

    protected $casts = [
        'month_year' => 'date',
        'submitted_at' => 'datetime',
        'processed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }
}
