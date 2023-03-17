<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $request->validate([
            'review' => 'required|string',
            'rating' => 'required|numeric',
            'restaurant_id' => 'required|integer|exists:App\Models\Restaurant,id'
        ]);

        $user = Auth::user();

        $review = new Review();
        $review->review = $request->review;
        $review->stars = $request->rating;
        $review->author = $user->name;
        $review->restaurant_id = $request->restaurant_id;
        $review->user_id = $user->id;
        $review->save();

        return redirect(route('reviews.index', ['restaurant' => $request->restaurant_id]));
    }

    public function update(Request $request, Review $review)
    {
        $this->authorize('update', $review);

        $validated = $request->validate([
            'review' => 'required|string',
            'stars' => 'required|numeric|min:1|max:5',
        ]);

        $review->update($validated);

        return redirect(route('reviews.index', ['restaurant' => $review->restaurant_id]));
    }

    public function destroy(Review $review)
    {
        $this->authorize('delete', $review);
        
        $restaurant_id = $review->restaurant_id;

        $review->delete();

        return redirect(route('reviews.index', ['restaurant' => $restaurant_id]));
    }
}
