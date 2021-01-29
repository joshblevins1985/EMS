<?php

namespace Vanguard\Providers;

use Vanguard\Http\Clients\FleetCompleteClient;
use Illuminate\Support\ServiceProvider;

class FleetCompleteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(FleetCompleteClient::class, function(){
            return new FleetCompleteClient([
                'base_uri' => 'tlshosted.fleetcomplete.com/v8_5_0/Integration/WebAPI/',
                'headers' => [
                    'ClientID' => '29863',
                    'UserID' => '5d94926d-f205-4126-ac35-ecd0a984dfe6',
                    'Token' => 'Wtu0lZb4NSLc/sqx8kZppO5MsYc='
                    ]
                ]);
        });
    }
}
