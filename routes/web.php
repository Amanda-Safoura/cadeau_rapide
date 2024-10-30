<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BackOffice\CustomerController;
use App\Http\Controllers\BackOffice\GiftCardController;
use App\Http\Controllers\BackOffice\PartnerCategoryController;
use App\Http\Controllers\BackOffice\PartnerController as BackOfficePartnerController;
use App\Http\Controllers\BackOffice\ReclamationController;
use App\Http\Controllers\BackOffice\ShippingController;
use App\Http\Controllers\BackOffice\UserMessageController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PartnerController as ClientPartnerController;
use App\Models\PartnerCategory;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::name('client.')->group(function () {
    Route::get('/', [ClientController::class, 'home'])->name('home');

    Route::get('/partners', [ClientPartnerController::class, 'index'])->name('partner.index');
    Route::get('/partner/result/{letter}', [ClientPartnerController::class, 'resultByLetter'])->name('partner.letter');
    Route::get('/partner_category/{name}', [ClientPartnerController::class, 'category'])->name('partner.category');
    Route::post('/partners/search/', [ClientPartnerController::class, 'search'])->name('partner.search');
    Route::get('/partner_profile/{partner_name}', [ClientPartnerController::class, 'profile'])->name('partner.show');

    Route::view('/contact', 'client_site.pages.contact_page', ['categories' => PartnerCategory::all()])->name('contact');
    Route::post('/user_message/store', [UserMessageController::class, 'store'])->name('user_message.store');

    Route::view('/register', 'client_site.pages.register', ['categories' => PartnerCategory::all()])->name('register_page');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    Route::view('/login', 'client_site.pages.login_page', ['categories' => PartnerCategory::all()])->name('login_page');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::middleware('auth')->group(function () {
        Route::get('/partner/{partner_name}', [ClientPartnerController::class, 'orderingPage'])->name('partner.ordering_page');
        Route::post('/gift_card/store', [ClientPartnerController::class, 'storeGiftCard'])->name('order.store');
        Route::get('/profile', [AuthController::class, 'profile'])->name('profile_page');
        Route::post('/reclamation/store', [ReclamationController::class, 'store'])->name('reclamation.store');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });


    Route::get('/storage/{filename}', [ImageController::class, 'showImage'])->name('image.show');
});



Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::view('/', 'backoffice.layouts.main')->name('global_stats');

    Route::get('/gift_card', [GiftCardController::class, 'index'])->name('gift_card.index');
    Route::get('/gift_card/{id}', [GiftCardController::class, 'show'])->name('gift_card.show');

    Route::get('/customers', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/customer/{id}', [CustomerController::class, 'show'])->name('customer.show');

    Route::get('/reclamations', [ReclamationController::class, 'index'])->name('reclamation.index');
    Route::post('reclamations/change_read_status', [ReclamationController::class, 'changeReadStatus'])->name('reclamations.change-read-status');

    Route::get('/user_messages', [UserMessageController::class, 'index'])->name('user_message.index');
    Route::post('user_message/change_read_status', [UserMessageController::class, 'changeReadStatus'])->name('user_messages.change-read-status');

    Route::resource('/shippings', ShippingController::class);
    Route::get('/shippings_all', [ShippingController::class, 'fetch_resource'])->name('shipping.fetch_all');

    Route::resource('/partner_categories', PartnerCategoryController::class);
    Route::get('/partner_categories_all', [PartnerCategoryController::class, 'fetch_resource'])->name('partner_category.fetch_all');

    Route::resource('/partners', BackOfficePartnerController::class);
    Route::post('/partners/suspense', [BackOfficePartnerController::class, 'suspense'])->name('partner.suspense');
    Route::get('/partners_all', [BackOfficePartnerController::class, 'fetch_resource'])->name('partner.fetch_all');
});
