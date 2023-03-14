<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    

    public function store(Request $request)
    {
        $review = new Review();
        $review->review = $request->review;
        $review->stars = $request->rating;
        $review->author = $request->name;
        $review->restaurant_id = $request->restaurant_id;
        $review->save();

        return redirect(route('reviews.index', ['restaurant' => $request->restaurant_id]));
    }
}
