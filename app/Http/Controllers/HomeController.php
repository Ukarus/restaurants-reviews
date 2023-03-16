<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    

    public function index(): View
    {
        $restaurants = Restaurant::with(['reviews'])->get();
        // dd($restaurants);
        return view('home', [
            'restaurants' => $restaurants
        ]);
    }

    public function show(Restaurant $restaurant): View
    {
        $restaurant->load('reviews');
        return view('reviews.index', [
            'restaurant' => $restaurant
        ]);
    }
}
