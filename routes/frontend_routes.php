<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;

Route::get('/home', [HomeController::class, 'index'])->name('user.index');

Route::prefix('product')->name('product.')->group(function () {
    Route::get('shop', [ProductController::class, 'shop'])->name('shop');
    Route::get('checkout', [ProductController::class, 'checkout'])->name('checkout');
    Route::get('shopdetail', [ProductController::class, 'shopDetail'])->name('shopdetail');
    Route::get('viewProduct/{id}', [ProductController::class, 'viewProduct'])->name('view.product');
    Route::get('cart/{id?}', [ProductController::class, 'cart'])->name('cart')->middleware('reset.cart.value');
    Route::post('addcart/{id}', [ProductController::class, 'AddToCart'])->name('AddToCart');
    Route::post('checkout', [ProductController::class, 'store'])->name('checkouts');
    Route::post('delete-item',  [ProductController::class, 'deleteItem'])->name('delete-item');

});
