<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

// all site pages starting /
Route::get('about', [SiteController::class, 'about'])->name('about');
Route::get('contact', [SiteController::class, 'contact'])->name('contact');
Route::get('shop', [SiteController::class, 'shop'])->name('shop');
Route::get('product-detail', [SiteController::class, 'productDetails'])->name('product.detail');
Route::get('shoping-cart', [SiteController::class, 'shopingCart'])->name('shoping.cart');
// all site pages end /

Route::get('/add-to-cart/{id}', [SiteController::class, 'addToCart'])->name('add.to.cart');
Route::get('/add-to-wishlist/{id}', [SiteController::class, 'addToWishlist'])->name('add.to.wishlist');
Route::get('/remove/{id}', [SiteController::class, 'removeCart'])->name('remove.cart');
Route::get('/remove/{id}', [SiteController::class, 'removeWishlist'])->name('remove.wishlist');

Route::get('/change-qty/{id}', [SiteController::class, 'changeQty'])->name('change.qty');
Route::post('/increment-cart/{id}', [SiteController::class, 'incrementCart'])->name('increment.cart');
Route::post('/decrement-cart/{id}', [SiteController::class, 'decrementCart'])->name('decrement.cart');
