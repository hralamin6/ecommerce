<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register ()
    {
        Paginator::useBootstrap ();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot (Request $request)
    {
        Model::preventLazyLoading (!app ()->isProduction ());
        if (Schema::hasTable ('settings') && DB::table ('settings')->where ('key', 'flash_start')->exists ()) {
            $settings = collect (DB::table ('settings')->get ());
            $flash_start = $settings->where ('key', 'flash_start')->first ()->value;
            $flash_end = $settings->where ('key', 'flash_end')->first ()->value;
            $notice = optional ($settings->where ('key', 'notice')->first ())->value;
            $inside_dhaka = optional ($settings->where ('key', 'inside_dhaka')->first ())->value;
            $outside_dhaka = optional ($settings->where ('key', 'outside_dhaka')->first ())->value;
            $show_flash = (Carbon::parse ($flash_start) <= now () && Carbon::parse ($flash_end) >= now ()) ?? false;
            View::share ('flash_end', Carbon::parse ($flash_end)->toDateTimeString () ?? now ()->subDay ());
            View::share ('show_flash', $show_flash ?? false);
            View::share ('notice', $notice ?? null);
            View::share ('inside_dhaka', $inside_dhaka ?? 60);
            View::share ('outside_dhaka', $outside_dhaka ?? 100);
            $payment_number = null;
            if (Schema::hasTable ('payment_methods')) {
                $payments = PaymentMethod::whereStatus (1)->pluck ('number', 'type');
                foreach ($payments as $type => $number) {
                    $payment_number .= "$number ($type), ";
                }

            }
            View::share ('payment_number', rtrim ($payment_number, ', '));
            if (Schema::hasTable ('categories') && Schema::hasColumn ('categories', 'category_id')) {
                $categories = DB::table ('categories')->where ('category_id', 0)->where ('categories.status', 1)->take (6)->get ([ 'name', 'slug', 'image', 'banner' ]);
            }
            View::share ('categories', $categories ?? []);
        }



    }
}
