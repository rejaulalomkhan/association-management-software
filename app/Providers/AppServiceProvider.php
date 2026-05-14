<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Hashing\Hasher;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Helper files are now loaded via composer autoload
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Override config values from the organization settings so that
        // the browser tab title, PWA manifest, tyro-login branding, etc.
        // all follow whatever the admin sets in /admin/settings.
        //
        // Wrapped in try/catch so that `artisan` commands run fine before
        // the database/settings table exists (e.g. during initial install).
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                $settings = app(\App\Services\SettingsService::class);
                $orgName = $settings->get('organization_name');
                $orgLogoPath = $settings->get('organization_logo');

                if (!empty($orgName)) {
                    config(['app.name' => $orgName]);

                    // Keep tyro-login branding in sync
                    if (config()->has('tyro-login.branding')) {
                        config(['tyro-login.branding.app_name' => $orgName]);
                    }
                    config(['tyro-login.name' => $orgName]);

                    // PWA manifest (laravelpwa package) — keep the installed
                    // app name aligned with the current org name too.
                    if (config()->has('laravelpwa.manifest')) {
                        config(['laravelpwa.manifest.name' => $orgName]);
                    }
                }

                if (!empty($orgLogoPath)) {
                    $logoUrl = asset('storage/' . $orgLogoPath);
                    if (config()->has('tyro-login.branding')) {
                        config(['tyro-login.branding.logo' => $logoUrl]);
                    }
                }
            }
        } catch (\Throwable $e) {
            // Settings table not ready yet — fall back to config/.env values.
        }

        // Custom validator to allow phone numbers in email field
        \Illuminate\Support\Facades\Validator::extend('email_or_phone', function ($attribute, $value, $parameters, $validator) {
            // Check if it's a valid email
            if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
                return true;
            }
            // Check if it's a phone number (digits, spaces, +, -, ())
            return preg_match('/^[0-9+\-\s()]+$/', $value);
        });

        // Override authentication to handle phone login
        Auth::provider('phone', function ($app, array $config) {
            return new class($app['hash'], $config['model']) extends EloquentUserProvider {
                public function retrieveByCredentials(array $credentials)
                {
                    if (empty($credentials) ||
                       (count($credentials) === 1 &&
                        str_contains($this->firstCredentialKey($credentials), 'password'))) {
                        return;
                    }

                    // If email field contains a phone number pattern, search by phone
                    $query = $this->newModelQuery();

                    foreach ($credentials as $key => $value) {
                        if (str_contains($key, 'password')) {
                            continue;
                        }

                        // Remove fake email domain if present
                        if ($key === 'email' && str_ends_with($value, '@phone.local')) {
                            $value = str_replace('@phone.local', '', $value);
                        }

                        // Check if the value looks like a phone number
                        if ($key === 'email' && preg_match('/^[0-9+\-\s()]+$/', $value)) {
                            $query->where('phone', $value);
                        } else {
                            $query->where($key, $value);
                        }
                    }

                    return $query->first();
                }

                protected function firstCredentialKey(array $credentials)
                {
                    foreach ($credentials as $key => $value) {
                        return $key;
                    }
                }
            };
        });
    }
}
