<?php

use App\Helpers\RoleHelper;

/**
 * Global Helper Functions for Role-Based Routing
 * These functions work with Tyro package for seamless role management
 */

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
