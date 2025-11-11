<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\AuthController;
use App\Http\Controllers\Api\User\ServiceController;
use App\Http\Controllers\Api\Cleaner\CleanerAuthController;
use App\Http\Controllers\Api\User\ReviewController;
use App\Http\Controllers\Api\User\PaymentController;
use App\Http\Controllers\Api\User\BookingController;
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


Route::middleware('auth:sanctum')->group(function () {

    Route::controller(AuthController::class)->group(function () {
        Route::get('logout', 'logout');
        Route::post('change-password', 'changePassword');
    });

    Route::controller(ServiceController::class)->group(function () {
        Route::get('get-services', 'getServices');
        Route::get('get-service-detail', 'getServiceDetail');
    });

    Route::controller(ReviewController::class)->group(function () {
        Route::post('create-review', 'createReview');
        Route::get('get-reviews', 'getReviews');
    });

    Route::controller(PaymentController::class)->group(function () {
        Route::post('setup-intent', 'createPaymentIntent');
        Route::post('payment', 'paymentConfirmation');
    });

    Route::controller(BookingController::class)->group(function () {
        Route::post('filter-cleaner', 'filterCleaner');
        Route::post('create-booking', 'createBooking');
        Route::get('my-booking', 'myBooking');
    });

});

Route::middleware('auth:cleaners')->group(function () {
    Route::controller(CleanerAuthController::class)->group(function () {
        Route::post('update-profile', 'updateProfile');
        Route::get('get-zones', 'getZones');
        Route::post('make-cleaner-online','makeCleanerOnline');
    });

});


// -----User Auth---- //
Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('forgot-password', 'forgotPassword');
    Route::post('otp-verification', 'otpVerification');
    Route::post('reset-password', 'resetPassword');
});


// Cleaner Auth //
Route::controller(CleanerAuthController::class)->group(function () {
    Route::prefix('cleaner')->group(function () {
        Route::post('register', 'register');
        Route::post('login', 'login');
        Route::post('forgot-password', 'forgotPassword');
        Route::post('otp-verification', 'otpVerification');
        Route::post('reset-password', 'resetPassword');

    });

});

