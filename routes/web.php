<?php

use App\Http\Controllers\ZoneController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CleanerController;
use App\Http\Controllers\PromoCodeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BannerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return view('index');
    })->name('dashboard');


    Route::controller(ZoneController::class)->group(function () {
        Route::get('zone-index', 'zoneIndex')->name('zoneIndex');
    });

    Route::controller(CategoriesController::class)->group(function () {
        Route::get('category-index', 'categoryIndex')->name('categoryIndex');
        Route::post('category-store', 'categoryStore')->name('categoryStore');
        Route::post('category-update', 'categoryUpdate')->name('categoryUpdate');
        Route::get('category-delete/{id}', 'categoryDelete')->name('categoryDelete');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('user-list', 'userList')->name('userList');
    });

    Route::controller(ServiceController::class)->group(function () {
        Route::get('service-index', 'serviceIndex')->name('serviceIndex');
        Route::get('service-create', 'serviceCreate')->name('serviceCreate');
        Route::post('service-store', 'serviceStore')->name('serviceStore');
        Route::get('service-edit/{serviceId}', 'serviceEdit')->name('serviceEdit');
        Route::get('service-delete/{serviceId}', 'serviceDelete')->name('serviceDelete');
    });

    Route::controller(BookingController::class)->group(function () {
        Route::get('booking-list', 'bookingList')->name('bookingList');
        Route::get('booking-detail/{id}', 'bookingDetail')->name('bookingDetail');

    });

    Route::controller(PromoCodeController::class)->group(function () {
        Route::get('promo-code-index', 'promoCodeIndex')->name('promoCodeIndex');
        Route::get('create-promo-code', 'createPromoCode')->name('createPromoCode');
        Route::post('store-promo-code', 'storePromoCode')->name('storePromoCode');
    });

    Route::controller(CleanerController::class)->group(function () {
        Route::get('cleaner-index', 'cleanerIndex')->name('cleanerIndex');
        Route::get('cleaner-detail/{id}', 'cleanerDetail')->name('cleanerDetail');
    });


    Route::controller(ZoneController::class)->group(function () {
        Route::get('zone-index', 'zoneIndex')->name('zoneIndex');
        Route::get('zone-create', 'zoneCreate')->name('zoneCreate');
        Route::post('zone-store', 'zoneStore')->name('zoneStore');
        Route::get('zone-edit/{zoneId}', 'zoneEdit')->name('zoneEdit');
        Route::post('zone-update', 'zoneUpdate')->name('zoneUpdate');
        Route::post('zone-update-status/{zoneId}', 'zoneUpdateStatus')->name('zoneUpdateStatus');
        Route::get('zone-delete/{zoneId}', 'zoneDelete')->name('zoneDelete');
        Route::get('zone-show/{zoneId}', 'zoneShow')->name('zoneShow');
    });

    Route::controller(AuthController::class)->group(function () {
        Route::get('edit-profile', 'editProfile')->name('editProfile');
    });

    Route::controller(BannerController::class)->group(function () {
        Route::get('create-banner', 'createBanner')->name('createBanner');
        Route::post('store-banner','storeBanner')->name('storeBanner');
    });

});

Route::controller(AuthController::class)->group(function () {
    Route::get('login-index', 'loginIndex')->name('loginIndex');
    Route::post('login', 'login')->name('login');
    Route::get('logout', 'logout')->name('logout');
});