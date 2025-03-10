<?php

    namespace App\Providers;

    use Illuminate\Support\Facades\Blade;
    use Illuminate\Support\ServiceProvider;

    class BladeServiceProvider extends ServiceProvider
    {
        /**
         * Register services.
         *
         * @return void
         */
        public function register()
        {
            //
        }

        /**
         * Bootstrap services.
         *
         * @return void
         */
        public function boot()
        {
            Blade::directive('taka', function ($expression) {
                return "<?php echo '৳ '.e({$expression}) ?>";
            });
            Blade::if('premium', function () {
                return auth()->check() && (auth()->user()->isPremium() || auth()->user()->isAdmin());
            });

        }
    }
