<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->randomElement([
            'Elektronik', 'Fashion Pria', 'Fashion Wanita', 'Kesehatan',
            'Olahraga', 'Buku', 'Mainan', 'Perlengkapan Rumah',
            'Otomotif', 'Kecantikan',
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name) . '-' . fake()->unique()->numberBetween(1, 999999),
        ];
    }
}