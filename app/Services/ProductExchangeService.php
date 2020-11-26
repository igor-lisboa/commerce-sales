<?php

namespace App\Services;

use App\Models\ProductExchange;

class ProductExchangeService extends BaseService
{
    /**
     * 
     * Init the class and inform the model
     * 
     * @param  \App\Models\ProductExchange  $productExchange
     */
    public function __construct(ProductExchange $productExchange)
    {
        parent::__construct($productExchange);
    }
}
