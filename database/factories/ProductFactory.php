<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'item_name' => fake()->unique()->words(2, true),
            'quantity' => fake()->numberBetween(5, 50),
            'price' => fake()->randomFloat(2, 1, 100),
        ];
    }

    /**
     * Out of stock product
     */
    public function outOfStock(): static
    {
        return $this->state(fn () => [
            'quantity' => 0,
        ]);
    }
}
