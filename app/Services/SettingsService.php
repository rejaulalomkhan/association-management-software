<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingsService
{
    /**
     * Get a setting value by key.
     */
    public function get(string $key, $default = null): mixed
    {
        return Cache::remember("setting_{$key}", 3600, function () use ($key, $default) {
            $setting = Setting::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    /**
     * Set a setting value.
     */
    public function set(string $key, $value): void
    {
        Setting::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );

        Cache::forget("setting_{$key}");
    }

    /**
     * Get multiple settings.
     */
    public function getMultiple(array $keys): array
    {
        $result = [];
        foreach ($keys as $key) {
            $result[$key] = $this->get($key);
        }
        return $result;
    }

    /**
     * Get organization settings.
     */
    public function getOrganizationSettings(): array
    {
        return $this->getMultiple([
            'organization_name',
            'organization_name_en',
            'organization_established_year',
            'organization_established_month',
            'monthly_fee',
            'organization_logo',
            'organization_address',
            'organization_phone',
            'currency',
            'currency_symbol',
        ]);
    }

    /**
     * Get monthly fee amount.
     */
    public function getMonthlyFee(): float
    {
        return (float) $this->get('monthly_fee', 500);
    }

    /**
     * Get organization established year.
     */
    public function getOrganizationEstablishedYear(): int
    {
        return (int) $this->get('organization_established_year', now()->year);
    }

    /**
     * Get organization established month.
     */
    public function getOrganizationEstablishedMonth(): int
    {
        return (int) $this->get('organization_established_month', 1);
    }

    /**
     * Get organization start date.
     */
    public function getOrganizationStartDate(): string
    {
        $year = $this->getOrganizationEstablishedYear();
        $month = $this->getOrganizationEstablishedMonth();
        return sprintf('%04d-%02d', $year, $month);
    }

    /**
     * Clear all settings cache.
     */
    public function clearCache(): void
    {
        Cache::flush();
    }
}
