<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\RefundPolicyController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\PaymentTransactionController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(static function () {

    // Guest routes
    Route::middleware('guest:admin')->group(static function () {
        // Auth routes
        Route::get('login', [\App\Http\Controllers\Admin\Auth\AuthenticatedSessionController::class, 'create'])->name('admin.login');
        Route::post('login', [\App\Http\Controllers\Admin\Auth\AuthenticatedSessionController::class, 'store']);
        // Forgot password
        Route::get('forgot-password', [\App\Http\Controllers\Admin\Auth\PasswordResetLinkController::class, 'create'])->name('admin.password.request');
        Route::post('forgot-password', [\App\Http\Controllers\Admin\Auth\PasswordResetLinkController::class, 'store'])->name('admin.password.email');
        // Reset password
        Route::get('reset-password/{token}', [\App\Http\Controllers\Admin\Auth\NewPasswordController::class, 'create'])->name('admin.password.reset');
        Route::post('reset-password', [\App\Http\Controllers\Admin\Auth\NewPasswordController::class, 'store'])->name('admin.password.update');
    });

    // Verify email routes
    Route::middleware(['auth:admin'])->group(static function () {
        Route::get('verify-email', [\App\Http\Controllers\Admin\Auth\EmailVerificationPromptController::class, '__invoke'])->name('admin.verification.notice');
        Route::get('verify-email/{id}/{hash}', [\App\Http\Controllers\Admin\Auth\VerifyEmailController::class, '__invoke'])->middleware(['signed', 'throttle:6,1'])->name('admin.verification.verify');
        Route::post('email/verification-notification', [\App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('admin.verification.send');
    });

    // Authenticated routes
    // Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['auth:admin', 'verified'])->group(static function () {
        // Confirm password routes
        Route::get('confirm-password', [\App\Http\Controllers\Admin\Auth\ConfirmablePasswordController::class, 'show'])->name('admin.password.confirm');
        Route::post('confirm-password', [\App\Http\Controllers\Admin\Auth\ConfirmablePasswordController::class, 'store']);
        // Logout route
        Route::post('logout', [\App\Http\Controllers\Admin\Auth\AuthenticatedSessionController::class, 'destroy'])->name('admin.logout');
        // General routes
        Route::get('dashboard', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.index');
        Route::get('profile', [\App\Http\Controllers\Admin\HomeController::class, 'profile'])->middleware('password.confirm.admin')->name('admin.profile');

        // Route::get('web-setting', [WebSettingController::class, 'index'])->name('web.setting');
        // Route::put('seo-setting', [WebSettingController::class, 'seo'])->name('seo.setting');
        // Route::put('smtp-setting', [WebSettingController::class, 'smtp'])->name('smtp.setting');

        Route::resources(
            [
                'category'      => CategoryController::class, //done
                'paymentMethod' => PaymentMethodController::class, // done
                'faq'           => FaqController::class, // done
                'coupon'       => CouponController::class, // done
            ],
            ['except' => ['create', 'show', 'edit'],]
        );

        Route::get('payment-transaction', [PaymentTransactionController::class, 'index'])->name('payment.transaction.index');
        Route::post('/update-transaction-status/{id}', [PaymentTransactionController::class, 'updateStatus'])->name('transaction.updateStatus');
        Route::delete('payment-transaction/{id}', [PaymentTransactionController::class, 'destroy'])->name('payment.transaction.destroy');

        Route::get('refund-policy', [RefundPolicyController::class, 'index'])->name('refund.policy.index');
        Route::put('refund-policy', [RefundPolicyController::class, 'refundPolicy'])->name('refund.policy.update.or.create');

        Route::resource('brand', BrandController::class); //done
        Route::resource('product', ProductController::class)->except(['show']); //done

        // Route::resource('contact', ContactController::class)->except(['create', 'show', 'edit'])
        //     ->middleware(['throttle:10,1', 'checkBan'], 'only', ['store']);

        // Route::get('/subscribers', [NewsletterController::class, 'index'])->name('newsletter.index');
        // Route::post('/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

        // Route::get('/verify/{token}', [NewsletterController::class, 'verify'])->name('newsletter.verify');

        // Route::get('/verified', function () {
        //     return view('newsletter.verified');
        // })->name('newsletter.verified');

        // Route::get('/verify-failed', function () {
        //     return view('newsletter.verify-failed');
        // })->name('newsletter.verify-failed');

        // Route::post('/unsubscribe', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

        // Route::resource('contact', ContactController::class)->except(['create', 'show', 'edit']); //example


    });
});
