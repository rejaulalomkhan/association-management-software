<?php

use App\Helpers\RoleHelper;
use App\Services\SettingsService;

/**
 * Global Helper Functions for Role-Based Routing
 * These functions work with Tyro package for seamless role management
 */

if (!function_exists('org_settings')) {
    /**
     * Get the SettingsService instance (lazy-resolved singleton).
     */
    function org_settings(): SettingsService
    {
        return app(SettingsService::class);
    }
}

if (!function_exists('org_name')) {
    /**
     * Organization name — always reads from settings so that changes in
     * the admin Settings page propagate everywhere instantly.
     */
    function org_name(?string $default = null): string
    {
        return (string) org_settings()->get(
            'organization_name',
            $default ?? config('app.name', 'Organization')
        );
    }
}

if (!function_exists('org_name_en')) {
    /**
     * English organization name (falls back to the Bengali name).
     */
    function org_name_en(?string $default = null): string
    {
        return (string) (org_settings()->get('organization_name_en') ?: org_name($default));
    }
}

if (!function_exists('org_logo_path')) {
    /**
     * Raw storage path of the organization logo (or null if not set).
     * Use org_logo_url() for a browser-ready URL.
     */
    function org_logo_path(): ?string
    {
        $path = org_settings()->get('organization_logo');
        return $path ? (string) $path : null;
    }
}

if (!function_exists('org_logo_url')) {
    /**
     * Full browser-accessible URL to the organization logo (or null).
     */
    function org_logo_url(): ?string
    {
        $path = org_logo_path();
        return $path ? asset('storage/' . $path) : null;
    }
}

if (!function_exists('org_address')) {
    function org_address(?string $default = ''): string
    {
        return (string) (org_settings()->get('organization_address') ?? $default);
    }
}

if (!function_exists('org_phone')) {
    function org_phone(?string $default = ''): string
    {
        return (string) (org_settings()->get('organization_phone') ?? $default);
    }
}

if (!function_exists('org_email')) {
    function org_email(?string $default = ''): string
    {
        return (string) (org_settings()->get('organization_email') ?? $default);
    }
}

if (!function_exists('org_monthly_fee')) {
    /**
     * Resolve the monthly fee for a given member (or the org default).
     *
     * Pass a `User` instance to get that member's effective fee (custom
     * override if set, otherwise the settings default). Pass nothing to
     * get the organization-wide default.
     *
     * This is the single helper front-end Blade views should use for
     * rendering "monthly fee" amounts, so the override rule stays
     * consistent across the entire app.
     */
    function org_monthly_fee(?\App\Models\User $user = null): float
    {
        if ($user instanceof \App\Models\User) {
            return $user->effectiveMonthlyFee();
        }

        return (float) org_settings()->getMonthlyFee();
    }
}

if (!function_exists('org_payment_term')) {
    /**
     * Resolve the effective payment term for a given member (or the
     * organization-wide default when no user is provided).
     *
     * Returns one of: monthly | yearly | lifetime.
     */
    function org_payment_term(?\App\Models\User $user = null): string
    {
        if ($user instanceof \App\Models\User) {
            return $user->effectivePaymentTerm();
        }

        return app(\App\Services\SettingsService::class)->getPaymentTerm();
    }
}

if (!function_exists('payment_term_label')) {
    /**
     * Bangla human label for a payment-term string.
     */
    function payment_term_label(string $term): string
    {
        return \App\Enums\PaymentTerm::label($term);
    }
}

if (!function_exists('user_role')) {
    /**
     * Get the current user's primary role name
     * Works with Tyro's role system
     *
     * @return string
     */
    function user_role()
    {
        return RoleHelper::getUserRole();
    }
}

if (!function_exists('role_route')) {
    /**
     * Generate a URL to a named route with user's role prefix
     *
     * Example: role_route('dashboard') becomes route('admin.dashboard') for admin users
     *
     * @param string $name Route name without role prefix
     * @param mixed $parameters Route parameters
     * @param bool $absolute Generate absolute URL
     * @return string
     */
    function role_route($name, $parameters = [], $absolute = true)
    {
        return RoleHelper::route($name, $parameters, $absolute);
    }
}

if (!function_exists('user_roles')) {
    /**
     * Get all roles assigned to the current user
     *
     * @return array
     */
    function user_roles()
    {
        return RoleHelper::getUserRoles();
    }
}
