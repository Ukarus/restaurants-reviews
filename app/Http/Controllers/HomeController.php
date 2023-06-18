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
        return view('home', [
            'restaurants' => $restaurants
        ]);
    }

    public function show(Restaurant $restaurant, Request $request): View
    {
        $user = $request->user();
        $review = null;
        if ($user != null) {
            $user->load('reviews');
            $review = $user->reviews()->where('user_id', $user->id)->get()->first();
        }
        $restaurant->load('reviews');

        return view('reviews.index', [
            'restaurant' => $restaurant,
            'user' => $user,
            'review' => $review
        ]);
    }
}
