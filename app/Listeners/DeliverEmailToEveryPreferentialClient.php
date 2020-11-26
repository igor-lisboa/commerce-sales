<?php

namespace App\Listeners;

use App\Events\SendPromotionToPreferentialClients;
use App\Mail\ProductsInPromotion;
use App\Models\Client;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class DeliverEmailToEveryPreferentialClient
{
    use InteractsWithQueue, ShouldQueue;

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
            Mail::send($email);
        }
    }
}
