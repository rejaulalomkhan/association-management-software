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
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
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
