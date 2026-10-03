<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'order_id'   => Order::factory(),
            'product_id' => Product::factory(),
            'qty'        => fake()->numberBetween(1, 5),
            'price'      => fake()->randomFloat(2, 15000, 5000000),
        ];
    }
}
