<?php

namespace App\Providers;

use App\Events\RequestPasswordChange;
use App\Events\SendPromotionToPreferentialClients;
use App\Listeners\DeliverEmailToEveryPreferentialClient;
use App\Listeners\SendMailRequestChangePassword;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        RequestPasswordChange::class => [
            SendMailRequestChangePassword::class,
        ],
        SendPromotionToPreferentialClients::class => [
            DeliverEmailToEveryPreferentialClient::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
