<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function show(Restaurant $restaurant, Request $request): View
    {
        // dd(Auth::user()->hasReviewForRestaurant($restaurant->id));
        $user = $request->user();
        $user->load('reviews');
        $restaurant->load('reviews');

        $review = $user->reviews()->where('user_id', $user->id)->get()->first();
        // dd($review);
        return view('reviews.index', [
            'restaurant' => $restaurant,
            'user' => $user,
            'review' => $review
        ]);
    }
}
