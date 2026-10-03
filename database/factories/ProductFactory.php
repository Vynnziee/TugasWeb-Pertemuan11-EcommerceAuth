<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'user_id'     => User::factory(),
            'name'        => ucfirst(fake()->words(3, true)),
            'description' => fake()->paragraph(),
            'price'       => fake()->randomFloat(2, 15000, 5000000),
            'stock'       => fake()->numberBetween(0, 200),
            'is_active'   => fake()->boolean(90),
        ];
    }
}
