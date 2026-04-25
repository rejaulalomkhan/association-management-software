<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Test that the home route redirects unauthenticated users to login.
     * This is the correct behavior - home should not be accessible without auth.
     */
    public function test_home_redirects_to_login_when_not_authenticated(): void
    {
        $response = $this->get('/');

        // Home route should redirect to login for unauthenticated users
        $response->assertStatus(302);
        $response->assertRedirect(route('tyro-login.login'));
    }
}
