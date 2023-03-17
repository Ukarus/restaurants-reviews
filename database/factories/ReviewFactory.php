<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $u = User::factory()->create();
        return [
            'user_id' => $u->id,
            'review' => fake()->text(),
            'author' => $u->name,
            'stars' => rand(1, 5),
        ];
    }
}
