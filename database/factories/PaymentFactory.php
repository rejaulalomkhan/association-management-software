<?php

namespace Database\Factories;

use App\Enums\PaymentTerm;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $months = ['January', 'February', 'March', 'April', 'May', 'June',
                   'July', 'August', 'September', 'October', 'November', 'December'];

        return [
            'user_id' => User::factory(),
            'transaction_id' => 'TXN-' . date('YmdHis') . '-' . strtoupper(fake()->bothify('??##')),
            'month' => fake()->randomElement($months),
            'year' => fake()->numberBetween(2024, date('Y')),
            'term' => PaymentTerm::MONTHLY,
            'amount' => fake()->randomFloat(2, 100, 1000),
            'method' => 'bKash',
            'payment_method_id' => PaymentMethod::factory(),
            'description' => fake()->optional()->sentence(),
            'proof_path' => fake()->optional()->filePath(),
            'status' => 'pending',
        ];
    }

    /**
     * Indicate that the payment is approved.
     */
    public function approved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'approved',
            'processed_at' => now(),
            'processed_by' => User::factory(),
        ]);
    }

    /**
     * Indicate that the payment is rejected.
     */
    public function rejected(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'rejected',
            'processed_at' => now(),
            'processed_by' => User::factory(),
            'admin_note' => fake()->sentence(),
        ]);
    }

    /**
     * Indicate that the payment is for a specific month and year.
     *
     * @param string $month Month name (e.g., 'January')
     * @param int $year Year
     */
    public function forMonth(string $month, int $year): static
    {
        return $this->state(fn (array $attributes) => [
            'month' => $month,
            'year' => $year,
        ]);
    }

    /**
     * Indicate that the payment is a yearly payment.
     */
    public function yearly(): static
    {
        return $this->state(fn (array $attributes) => [
            'term' => PaymentTerm::YEARLY,
            'amount' => fake()->randomFloat(2, 1000, 12000),
        ]);
    }

    /**
     * Indicate that the payment is a monthly payment.
     */
    public function monthly(): static
    {
        return $this->state(fn (array $attributes) => [
            'term' => PaymentTerm::MONTHLY,
        ]);
    }
}