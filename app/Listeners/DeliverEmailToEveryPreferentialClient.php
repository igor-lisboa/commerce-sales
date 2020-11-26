<?php

namespace App\Listeners;

use App\Events\SendPromotionToPreferentialClients;
use App\Jobs\SendEmail;
use App\Mail\ProductsInPromotion;
use App\Models\Client;
use Illuminate\Queue\InteractsWithQueue;

class DeliverEmailToEveryPreferentialClient
{
    use InteractsWithQueue;

    private $clients;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->clients = Client::where('preferential', '=', 1)->get();
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SendPromotionToPreferentialClients  $event
     * @return void
     */
    public function handle(SendPromotionToPreferentialClients $event)
    {
        foreach ($this->clients as $client) {
            $email = new ProductsInPromotion($client);
            $emailJob = new SendEmail($email);
            dispatch_now($emailJob);
        }
    }
}
