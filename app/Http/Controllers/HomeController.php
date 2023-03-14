<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    

    public function index(Request $request)
    {
        $restaurants = Restaurant::with(['reviews'])->get();
        // dd($restaurants);
        return view('home', [
            'restaurants' => $restaurants
        ]);
    }

    public function show(Restaurant $restaurant)
    {
        $restaurant->load('reviews');
        return view('reviews.index', [
            'restaurant' => $restaurant
        ]);
    }
}
