<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\CustomLog;
use App\Models\GiftCard;
use App\Models\Partner;
use App\Observers\GiftCardObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        GiftCard::observe(GiftCardObserver::class);

        View::composer('partner_backoffice.pages.*', function ($view) {

            $partner = Partner::find(request()->cookie('partner_id'));
            $view->with('partner', $partner);
        });


        View::composer('backoffice.pages.*', function ($view) {

            $admin = Admin::find(request()->cookie('admin_id'));
            $activities = CustomLog::where('read', false)->latest()->take(7)->get();

            $view->with(['admin' => $admin, 'activities' => $activities]);
        });
    }
}
