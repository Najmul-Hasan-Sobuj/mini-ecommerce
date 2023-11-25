<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;

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


    // all site pages starting /
    Route::get('about', [SiteController::class, 'about'])->name('about');
    Route::get('shop', [SiteController::class, 'shop'])->name('shop');
    Route::get('product-detail/{slug}', [SiteController::class, 'productDetails'])->name('product.detail');
    Route::get('shoping-cart', [SiteController::class, 'shopingCart'])->name('shoping.cart');
    // all site pages end /

    Route::post('add-to-cart', [SiteController::class, 'addToCart'])->name('add.cart');
    Route::get('cart-clear', [SiteController::class, 'cartClear'])->name('cart.clear');
    Route::get('cart-remove/{id}', [SiteController::class, 'cartRemove'])->name('cart.remove');
    Route::post('cart/quantity/change/{id}', [SiteController::class, 'cartQuantityChange'])->name('cart.quantity.change');
    Route::get('cart-increment/{id}', [SiteController::class, 'cartIncrement'])->name('cart.increment');
    Route::get('cart-decrement/{id}', [SiteController::class, 'cartDecrement'])->name('cart.decrement');

    Route::get('contact', [ContactController::class, 'show'])->name('contact');
    Route::post('contact/submit', [ContactController::class, 'submit'])->name('contact.submit');

    Route::get('checkout', [SiteController::class, 'checkout'])->name('checkout');
    Route::get('payment-confirmed', [SiteController::class, 'paymentConfirmed'])->name('payment.confirmed');
    
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
