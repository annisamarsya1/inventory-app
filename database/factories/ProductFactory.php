<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
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
            'name' => $this->faker->word() . ' ' . $this->faker->word(),
            'category_id' => \App\Models\Category::inRandomOrder()->first()?->id ?? \App\Models\Category::factory()->create()->id,
            'price' => $this->faker->numberBetween(10000, 5000000),
            'stock' => $this->faker->numberBetween(1, 100),
            'status' => $this->faker->randomElement(['tersedia', 'habis']),
            'description' => $this->faker->sentence(),
        ];
    }
}
