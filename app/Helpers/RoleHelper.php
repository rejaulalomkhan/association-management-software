<?php

namespace App\Helpers;

/**
 * Role Helper - Works with Tyro package for role-based routing
 *
 * This helper simplifies role detection and routing by working with the Tyro package.
 * It automatically detects user roles and provides convenience methods for role-based operations.
 */
class RoleHelper
{
    /**
     * Get the current user's primary role name for routing
     * Priority: admin > accountant > member
     *
     * @return string
     */
    public static function getUserRole()
    {
        $user = auth()->user();

        if (!$user) {
            return 'guest';
        }

        // Check roles in priority order using Tyro's hasRole method
        if ($user->hasRole('admin')) {
            return 'admin';
        }

        if ($user->hasRole('accountant')) {
            return 'accountant';
        }

        if ($user->hasRole('member')) {
            return 'member';
        }

        // Fallback: check if user has any custom role from settings
        $userRoles = $user->roles->pluck('name')->toArray();
        if (!empty($userRoles)) {
            return $userRoles[0]; // Return first role as primary
        }

        // Default fallback
        return 'member';
    }

    /**
     * Generate a URL to a named route with user's role prefix
     * Example: route('dashboard') becomes route('admin.dashboard') for admin
     *
     * If user is not authenticated, returns login route
     *
     * @param string $routeName
     * @param mixed $parameters
     * @param bool $absolute
     * @return string
     */
    public static function route($routeName, $parameters = [], $absolute = true)
    {
        // If user is not authenticated, redirect to login
        if (!auth()->check()) {
            return route('tyro-login.login', [], $absolute);
        }

        $role = self::getUserRole();
        return route($role . '.' . $routeName, $parameters, $absolute);
    }

    /**
     * Get all user roles (useful for checking multiple roles)
     *
     * @return array
     */
    public static function getUserRoles()
    {
        $user = auth()->user();

        if (!$user) {
            return [];
        }

        return $user->roles->pluck('name')->toArray();
    }
}

