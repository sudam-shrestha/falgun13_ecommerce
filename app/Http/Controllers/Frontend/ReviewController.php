<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:3|max:500'
        ]);

        // Check if user has already reviewed this product
        $existingReview = Review::where('product_id', $request->product_id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingReview) {
            return response()->json([
                'success' => false,
                'message' => 'You have already reviewed this product.'
            ], 400);
        }

        // Check if user has purchased this product and order is delivered
        $hasPurchased = Order::where('user_id', Auth::id())
            ->where('status', 'delivered')
            ->whereHas('items', function ($query) use ($request) {
                $query->where('product_id', $request->product_id);
            })
            ->exists();

        if (!$hasPurchased) {
            return response()->json([
                'success' => false,
                'message' => 'You can only review products you have purchased and received.'
            ], 403);
        }

        $review = Review::create([
            'product_id' => $request->product_id,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for your review!',
            'review' => $review
        ]);
    }

    public function check($product_id)
    {
        $hasReviewed = Review::where('product_id', $product_id)
            ->where('user_id', Auth::id())
            ->exists();

        $canReview = false;
        if (!$hasReviewed) {
            $canReview = Order::where('user_id', Auth::id())
                ->where('status', 'delivered')
                ->whereHas('items', function ($query) use ($product_id) {
                    $query->where('product_id', $product_id);
                })
                ->exists();
        }

        return response()->json([
            'has_reviewed' => $hasReviewed,
            'can_review' => $canReview
        ]);
    }

    public function getProductReviews($product_id)
    {
        $reviews = Review::with('user')
            ->where('product_id', $product_id)
            ->latest()
            ->get();

        $averageRating = $reviews->avg('rating');
        $totalReviews = $reviews->count();

        // Rating distribution
        $ratingDistribution = [];
        for ($i = 5; $i >= 1; $i--) {
            $ratingDistribution[$i] = $reviews->where('rating', $i)->count();
        }

        return response()->json([
            'success' => true,
            'reviews' => $reviews,
            'average_rating' => round($averageRating, 1),
            'total_reviews' => $totalReviews,
            'rating_distribution' => $ratingDistribution
        ]);
    }
}
