<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Restaurant::factory()
        ->count(10)
        // ->has(Review::factory()->count(5))
        ->create();
    }
}
