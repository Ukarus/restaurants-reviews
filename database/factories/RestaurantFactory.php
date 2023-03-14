<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $foodId = rand(1, 22);
        return [
            'name' => fake()->company(),
            'description' => fake()->catchPhrase(),
            'address' => fake()->address(),
            'photo' => "https://storage.googleapis.com/firestorequickstarts.appspot.com/food_$foodId.png"
        ];
    }
}
