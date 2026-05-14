<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * PaymentMethod model for storing available payment methods.
 *
 * @property string $name Payment method name (English)
 * @property string|null $name_bn Payment method name (Bengali)
 * @property bool $is_active Whether the method is active
 * @property int $order Display order
 */
class PaymentMethod extends Model
{
    use HasFactory;
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
