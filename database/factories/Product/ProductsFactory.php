<?php

namespace Database\Factories\Product;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->text(5),
            'description' =>  fake()->text(),
            'thumbnail' =>  fake()->imageUrl(800, 600),
            'category' => rand(1, 20),
            'amount' => rand(50, 10000),
            'qty' => rand(5, 50),
            'wQty' => rand(10, 30),
            'status' => 1,
            'discountType' => rand(0, 1),
            'discountData' => json_encode(rand(0, 5)),
            'sku' => Str::random(8),
        ];
    }

    public function shortDesc(): Factory
    {
        return $this->state(fn(array $attributes) => [
            'shortDescription' => fake()->text(15),
        ]);
    }
}
