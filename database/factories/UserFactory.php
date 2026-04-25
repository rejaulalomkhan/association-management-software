<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->unique()->numerify('01#########'),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'father_name' => fake()->name(),
            'dob' => fake()->date('Y-m-d', '-30 years'),
            'permanent_address' => fake()->address(),
            'present_address' => fake()->address(),
            'blood_group' => fake()->randomElement(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-']),
            'profession' => fake()->jobTitle(),
            'religion' => fake()->randomElement(['ইসলাম', 'হিন্দু', 'খ্রিস্টান', 'বৌদ্ধ']),
            'nationality' => 'Bangladeshi',
            'position' => fake()->optional()->word(),
            'status' => 'active',
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Indicate that the user is a pending member.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
        ]);
    }

    /**
     * Indicate that the user is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'inactive',
        ]);
    }

    /**
     * Indicate that the user has a membership ID.
     */
    public function withMembershipId(): static
    {
        return $this->state(fn (array $attributes) => [
            'membership_id' => 'PUM-' . date('y') . '-' . str_pad(fake()->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT),
            'joined_at' => now(),
        ]);
    }

    /**
     * Indicate that the user has a verification token.
     */
    public function withVerificationToken(): static
    {
        return $this->state(fn (array $attributes) => [
            'verification_token' => bin2hex(random_bytes(16)),
        ]);
    }
}
