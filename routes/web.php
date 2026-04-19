<?php

use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\ReviewController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get("/", [PageController::class, "home"])->name("home");
Route::post("/dokan-registration", [PageController::class, "dokan_registration"])->name("dokan_registration");
Route::get("/product/{slug}", [PageController::class, "product"])->name("product");
Route::get("/products", [PageController::class, "products"])->name("products");
Route::get("/deals", [PageController::class, "deals"])->name("deals");

// Login Routes
Route::middleware('guest')->group(function () {
    Route::get("/login", [AuthController::class, "login"])->name("login");
    Route::get("/google/redirect", [AuthController::class, "redirect"])->name("google.redirect");
    Route::get("/google/callback", [AuthController::class, "callback"])->name("google.callback");
});


Route::middleware('auth')->group(function () {
    Route::delete("/logout", [AuthController::class, "logout"])->name("logout");

    // Cart Routes
    Route::get("/carts", [CartController::class, "index"])->name("cart");
    Route::post("/add-to-cart", [CartController::class, "store"])->name("cart.add");
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'delete'])->name('cart.remove');
    Route::delete('/cart/clear', [CartController::class, 'clear_cart'])->name('cart.clear');


    Route::post('/checkout/{id}', [OrderController::class, 'checkout'])->name('checkout.dokan');
    Route::get("/khalti/callback", [OrderController::class, "callback"])->name("khalti.callback");
    Route::get("/order/history", [OrderController::class, "history"])->name("order.history");

    Route::get('/payment/retry/{id}', [OrderController::class, 'payment_retry'])->name('payment.retry');
    Route::get('/order/details/{id}', [OrderController::class, 'getOrderDetails'])->name('order.details');

    Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');
    Route::get('/review/check/{product_id}', [ReviewController::class, 'check'])->name('review.check');
    Route::get('/product/reviews/{product_id}', [ReviewController::class, 'getProductReviews'])->name('product.reviews');
});


Route::middleware(['auth:dokan'])->prefix('dokan')->name('dokan.')->group(function () {
    Route::get('/order/details/{record}', [OrderController::class, 'dokan_order'])->name('order.details');
    Route::get('/order/receipt/{id}', [OrderController::class, 'downloadDokanReceipt'])->name('receipt.download');
});
