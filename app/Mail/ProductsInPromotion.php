<?php

namespace App\Mail;

use App\Models\Client;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductsInPromotion extends Mailable
{
    use Queueable, SerializesModels;

    private $client;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.client.products-in-promotion', ['products' => Product::whereNotNull('price_cents_promotion')->get(), 'client' => $this->client])->to($this->client->email, $this->client->name)->subject(__('subject_email_products_in_promotion'));
    }
}
