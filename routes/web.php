<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\Product;
use App\Models\Content;
use App\Models\Review;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Api\TrackingEventController;

Route::get('/', function () {
    $posts = Post::latest()->get();
    $product = Product::where('is_active', true)->first();
    $products = Product::where('is_active', true)->get();
    $contents = Content::pluck('value', 'key');
    $reviews = Review::where('is_published', true)->latest()->get();

    return view('landing', compact('posts', 'product', 'products', 'contents', 'reviews'));
});

// App login fallback route (redirect to Filament admin login)
Route::get('/login', function () {
    return redirect('/admin/login');
})->name('login');

// Always send /admin to the Filament login screen
Route::get('/admin', function () {
    return redirect('/admin/login');
});

// Optional no-register route to avoid broken link on the welcome page.
Route::get('/register', function () {
    abort(404);
});

Route::post('/order', [OrderController::class, 'store'])->name('order.store');

Route::post('/track-event', [TrackingEventController::class, 'store'])
    ->middleware('throttle:track-events')
    ->name('track-event.store');