<?php

namespace Database\Factories;

use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentMethod>
 */
class PaymentMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $order = 0;

        return [
            'name' => fake()->randomElement(['bKash', 'Nagad', 'Rocket', 'Hand Cash', 'Bank Transfer']),
            'name_bn' => fake()->randomElement(['বিকাশ', 'নগদ', 'রকেট', 'হাতে নগদ', 'ব্যাংক ট্রান্সফার']),
            'is_active' => true,
            'order' => ++$order,
        ];
    }

    /**
     * Indicate that the payment method is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}