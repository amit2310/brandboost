<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ChargeBeeServiceProvider extends ServiceProvider {

    /**
     * Register services.
     *
     * @return void
     */
    public function register() {
        $file = 'chargebee-php/lib/ChargeBee.php';
        if (file_exists($file)) {

            require_once($file);
            $cbSite = config('bbconfig.cb_site_name');
            $cbSiteToken = config('bbconfig.cb_access_token');
            if (class_exists('ChargeBee_Environment')) {
                $method = get_class_methods('ChargeBee_Environment');
                ChargeBee_Environment::configure($cbSite, $cbSiteToken);
                dd('class exists');
            }
            //ChargeBee_Environment::configure($cbSite, $cbSiteToken);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {
        //
    }

}
