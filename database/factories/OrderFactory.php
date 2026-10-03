<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'status'  => fake()->randomElement(['pending', 'paid', 'shipped', 'cancelled']),
            'total'   => 0, // dihitung ulang setelah order_items dibuat (lihat Seeder)
        ];
    }
}
