<?php

use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\PartnerController as AuthPartnerController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BackOffice\AdminController as BackOfficeAdminController;
use App\Http\Controllers\BackOffice\CustomerController;
use App\Http\Controllers\BackOffice\EmailTemplateController;
use App\Http\Controllers\BackOffice\FinanceController;
use App\Http\Controllers\BackOffice\GiftCardController;
use App\Http\Controllers\BackOffice\HomeController as BackOfficeHomeController;
use App\Http\Controllers\BackOffice\PartnerCategoryController;
use App\Http\Controllers\BackOffice\PartnerController as BackOfficePartnerController;
use App\Http\Controllers\BackOffice\PartnerMessageController;
use App\Http\Controllers\BackOffice\ReclamationController;
use App\Http\Controllers\BackOffice\ShippingController;
use App\Http\Controllers\BackOffice\StatsController;
use App\Http\Controllers\BackOffice\UserMessageController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PartnerController as ClientPartnerController;
use App\Http\Controllers\PartnerDashBoard\HomeController;
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

Route::get('/password-reset', [PasswordResetController::class, 'showResetRequestForm'])->name('password.request');
Route::post('/password-reset', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
Route::get('/password-reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/password-reset/{token}', [PasswordResetController::class, 'resetPassword'])->name('password.update');

Route::name('client.')->group(function () {
    Route::get('/', [ClientController::class, 'home'])->name('home');

    Route::get('/partners', [ClientPartnerController::class, 'index'])->name('partner.index');
    Route::get('/partners/popularity_sorting', [ClientPartnerController::class, 'index_popularity_sorting'])->name('partner.popularity_sorting.index');
    Route::get('/partner/result/{letter}', [ClientPartnerController::class, 'resultByLetter'])->name('partner.letter');
    Route::get('/partner_category/{name}', [ClientPartnerController::class, 'category'])->name('partner.category');
    Route::get('/partners/search/', [ClientPartnerController::class, 'search'])->name('partner.search');
    Route::get('/partner_profile/{slug}', [ClientPartnerController::class, 'profile'])->name('partner.show');


    Route::view('/about', 'new_client_site.pages.about_page')->name('about');

    Route::view('/policy', 'new_client_site.pages.policy_page')->name('policy');
    Route::view('/general_terms', 'new_client_site.pages.general_terms_page')->name('general_terms');

    Route::view('/contact', 'new_client_site.pages.contact_page')->name('contact');
    Route::post('/user_message/store', [UserMessageController::class, 'store'])->name('user_message.store');

    Route::view('/register', 'new_client_site.pages.auth.register_page')->name('register_page');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    Route::view('/login', 'new_client_site.pages.auth.login_page')->name('login_page');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::get('/verify_email/{token}', [AuthController::class, 'verify_email'])->name('verify-email');
    Route::get('/change-pasword/{origin_hashed}', [AuthController::class, 'change_password_page'])->name('change_password-page');
    Route::post('/change-pasword', [AuthController::class, 'change_password'])->name('change_password');


    Route::middleware('auth')->group(function () {
        Route::get('/partner/{slug}', [ClientPartnerController::class, 'orderingPage'])->name('partner.ordering_page');
        Route::post('/gift_card/store', [PaymentController::class, 'storeGiftCard'])->name('order.store');
        Route::get('/profile', [AuthController::class, 'profile'])->name('profile_page');
        Route::post('/reclamation/store', [ReclamationController::class, 'store'])->name('reclamation.store');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });


    Route::get('/storage/{filename}', [ImageController::class, 'showImage'])->name('image.show');

    Route::get('/check_validity/{gift_card_id}', [GiftCardController::class, 'check'])->name('gift_card.check');
    Route::post('/gift_card/mark_as_used/{id}', [HomeController::class, 'gift_card_mark_as_used'])->name('gift_card.do_mark_as_used');

    Route::get('/gift_card/download/{id}', [GiftCardController::class, 'generateGiftCard'])->name('gift_card.generatePDF');
});



Route::prefix('dashboard')->name('dashboard.')->group(function () {

    //Connexion
    Route::name('auth.')->group(function () {
        Route::get('/login', [AdminController::class, 'login'])->name('login_page');
        Route::post('/login', [AdminController::class, 'do_login'])->name('login');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    });


    Route::middleware('admin')->group(function () {
        Route::get('/', [BackOfficeHomeController::class, 'overviewStats'])->name('global_stats');

        Route::get('/activities', [BackOfficeHomeController::class, 'showActivities'])->name('logs');
        Route::get('/activities/activities-data', [BackOfficeHomeController::class, 'getActivitiesData'])->name('logs.data');
        Route::post('/activities/change-read-status', [BackOfficeHomeController::class, 'bulkUpdate'])->name('logs.change-read-status');


        Route::get('/sales_stats', [StatsController::class, 'getSalesStats'])->name('stats.sales');
        Route::get('/sales_stats_by_category', [StatsController::class, 'getSalesByCategory'])->name('stats.sales_by_category');
        Route::get('/reports_customizations', [StatsController::class, 'customizationsReport'])->name('stats.reports_customizations');

        Route::get('/gift_card/settings', [GiftCardController::class, 'settings'])->name('gift_card.settings');
        Route::post('/gift_card/update_settings', [GiftCardController::class, 'update_settings'])->name('gift_card.update_settings');

        Route::get('/gift_card/change_delivery_status', [GiftCardController::class, 'change_delivery_status'])->name('gift_card.change_delivery_status');

        Route::get('/gift_card', [GiftCardController::class, 'index'])->name('gift_card.index');
        Route::get('/gift_card/{id}', [GiftCardController::class, 'show'])->name('gift_card.show');

        Route::get('/customers', [CustomerController::class, 'index'])->name('customer.index');
        Route::get('/customer/{id}', [CustomerController::class, 'show'])->name('customer.show');

        Route::get('email-templates', [EmailTemplateController::class, 'index'])->name('email_templates.index');
        Route::get('email-templates/{id}/edit', [EmailTemplateController::class, 'edit'])->name('email_templates.edit');
        Route::post('email-templates/{id}', [EmailTemplateController::class, 'update'])->name('email_templates.update');

        Route::get('/reclamations', [ReclamationController::class, 'index'])->name('reclamation.index');
        Route::post('reclamations/change_read_status', [ReclamationController::class, 'changeReadStatus'])->name('reclamations.change-read-status');

        Route::get('/user_messages', [UserMessageController::class, 'index'])->name('user_message.index');
        Route::post('user_message/change_read_status', [UserMessageController::class, 'changeReadStatus'])->name('user_messages.change-read-status');

        Route::get('/partner_messages', [PartnerMessageController::class, 'index'])->name('partner_message.index');
        Route::post('partner_message/change_read_status', [PartnerMessageController::class, 'changeReadStatus'])->name('partner_messages.change-read-status');

        Route::resource('/shippings', ShippingController::class);
        Route::get('/shippings_all', [ShippingController::class, 'fetch_resource'])->name('shipping.fetch_all');
        Route::get('/shipping/to_deliver', [GiftCardController::class, 'to_deliver'])->name('shipping.to_deliver');

        Route::resource('/partner_categories', PartnerCategoryController::class);
        Route::get('/partner_categories_all', [PartnerCategoryController::class, 'fetch_resource'])->name('partner_category.fetch_all');

        Route::resource('/partners', BackOfficePartnerController::class);
        Route::post('/partners/suspense', [BackOfficePartnerController::class, 'suspense'])->name('partner.suspense');
        Route::get('/partners_all', [BackOfficePartnerController::class, 'fetch_resource'])->name('partner.fetch_all');

        Route::resource('/admin_accounts', BackOfficeAdminController::class);
        Route::post('/admin_accounts/suspense', [BackOfficeAdminController::class, 'suspense'])->name('admin_accounts.suspense');
        Route::get('/admin_accounts_all', [BackOfficeAdminController::class, 'fetch_resource'])->name('admin_accounts.fetch_all');

        Route::get('/cash_entries', [FinanceController::class, 'cash_entries'])->name('cash_entries');

        Route::get('/finance/card_payment_to_validate', [FinanceController::class, 'card_payment_to_validate'])->name('finance.card_payment_to_validate');
        Route::get('/finance/change_payment_status', [FinanceController::class, 'change_payment_status'])->name('finance.change_payment_status');


        Route::view('/all_icon', 'backoffice.pages.all_icon')->name('all_icon');
    });
});



Route::prefix('partner-panel')->name('partner.')->group(function () {

    Route::name('panel.')->middleware('partner')->group(function () {

        Route::get('/', [HomeController::class, 'overview'])->name('global_stats');
        Route::get('/sales_stats', [HomeController::class, 'salesStatistics'])->name('sales_stats');

        Route::get('/gift_card', [HomeController::class, 'gift_card_index'])->name('gift_card');
        Route::get('/gift_card/{id}', [HomeController::class, 'gift_card_show'])->name('gift_card.show');

        Route::get('/cash_entries', [HomeController::class, 'cash_entries'])->name('cash_entries');

        Route::get('/profile', [HomeController::class, 'profile_edit'])->name('profile');
        Route::post('/profile', [HomeController::class, 'profile_update'])->name('profile.update');

        // Route::post('/partners/suspense', [HomeController::class, 'suspense'])->name('partner.suspense');


        Route::get('/messages', [HomeController::class, 'message_index'])->name('message.index');
        Route::post('/message/store', [HomeController::class, 'message_store'])->name('message.store');
    });

    //Connexion
    Route::name('auth.')->group(function () {
        Route::get('/login', [AuthPartnerController::class, 'login'])->name('login_page');
        Route::post('/login', [AuthPartnerController::class, 'do_login'])->name('login');
        Route::post('/logout', [AuthPartnerController::class, 'logout'])->name('logout');
    });
});
