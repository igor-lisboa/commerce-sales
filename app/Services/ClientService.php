<?php

namespace App\Services;

use App\Models\Client;

class ClientService extends BaseService
{
    /**
     * 
     * Init the class and inform the model
     * 
     * @param  \App\Models\Client  $client
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
    }
}
