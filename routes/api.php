<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// // Resource Routes for Category, PaymentMethod, FAQ, and Coupon
// Route::apiResources([
//     'categories'      => CategoryController::class,
//     'payment-methods' => PaymentMethodController::class,
//     'faqs'            => FaqController::class,
//     'coupons'         => CouponController::class,
// ], ['except' => ['create', 'show', 'edit']]);

// // Routes for Payment Transactions
// Route::get('payment-transactions', [PaymentTransactionController::class, 'index']);
// Route::post('update-transaction-status/{id}', [PaymentTransactionController::class, 'updateStatus']);
// Route::delete('payment-transactions/{id}', [PaymentTransactionController::class, 'destroy']);

// // Routes for Refund Policy
// Route::get('refund-policy', [RefundPolicyController::class, 'index']);
// Route::put('refund-policy', [RefundPolicyController::class, 'refundPolicy']);

// // Resource Routes for Brand and Product
// Route::apiResource('brands', BrandController::class);
// Route::apiResource('products', ProductController::class)->except(['show']);
