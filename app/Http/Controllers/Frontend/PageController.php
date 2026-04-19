<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\DokanRequestNotification;
use App\Models\Admin;
use App\Models\Dokan;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function home()
    {
        $products = Product::orderBy('id', 'desc')->take(8)->get();
        return view('frontend.home', compact('products'));
    }

    public function dokan_registration(Request $request)
    {
        $request->validate([
            "name" => "required|max:60",
            "email" => "required|email|unique:dokans,email",
            "contact_no" => "required|numeric|unique:dokans,contact_no",
            "message" => "required|max:255",
        ]);
        $dokan = new Dokan();
        $dokan->name = $request->name;
        $dokan->email = $request->email;
        $dokan->contact_no = $request->contact_no;
        $dokan->message = $request->message;
        $dokan->save();
        $admins = Admin::all();
        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new DokanRequestNotification($dokan));
        }
        toast("Registration successful", "success");
        return redirect()->route('home');
    }

    public function product($slug)
    {
        $product = Product::where('slug', $slug)
            ->with(['dokan', 'reviews.user'])
            ->firstOrFail();

        $averageRating = $product->reviews()->avg('rating');
        $reviewsCount = $product->reviews()->count();

        // Check if current user can review
        $canReview = false;
        $hasReviewed = false;

        if (Auth::check()) {
            $hasReviewed = $product->reviews()->where('user_id', Auth::id())->exists();

            if (!$hasReviewed) {
                $canReview = Order::where('user_id', Auth::id())
                    ->where('status', 'delivered')
                    ->whereHas('items', function ($query) use ($product) {
                        $query->where('product_id', $product->id);
                    })
                    ->exists();
            }
        }

        return view('frontend.product', compact('product', 'averageRating', 'reviewsCount', 'canReview', 'hasReviewed'));
    }

    public function products()
    {
        $products = Product::orderBy('id', 'desc')->get();
        return view('frontend.products', compact('products'));
    }

    public function deals()
    {
        $deals = Product::orderBy('id', 'desc')->where('discount', '>', 0)->get();
        return view('frontend.deals', compact('deals'));
    }
}
