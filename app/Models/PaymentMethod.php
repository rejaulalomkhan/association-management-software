<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentMethod extends Model
{
    protected $fillable = [
        'name',
        'name_bn',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get all payments using this method.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Scope to get only active payment methods.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    /**
     * Get localized name based on app locale.
     */
    public function getLocalizedNameAttribute(): string
    {
        return app()->getLocale() === 'bn' && $this->name_bn
            ? $this->name_bn
            : $this->name;
    }
}
