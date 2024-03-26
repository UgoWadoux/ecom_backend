<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
            'name'=>$this->faker->word(),
            'price'=>$this->faker->numberBetween(1,200),
            'description'=>$this->faker->sentence(10, true),
            'category_id'=>Str::uuid(),
            'image'=>$this->faker->imageUrl()

        ];
    }
}
