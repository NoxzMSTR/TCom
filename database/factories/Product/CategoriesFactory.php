<?php

namespace Database\Factories\Product;

use App\Models\Product\Categories;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CategoriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->firstName(),
            'thumbnail' =>  fake()->imageUrl(800, 600),
            'parent' => 0,
        ];
    }


    public function parent(): Factory
    {
        return $this->state(fn(array $attributes) => [
            'parent' => $this->factoryForModel(Categories::class)->create()->id,
        ]);
    }
}
