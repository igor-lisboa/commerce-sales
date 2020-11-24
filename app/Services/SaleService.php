<?php

namespace App\Services;

use App\Models\Sale;

class SaleService extends BaseService
{
    /**
     * 
     * Init the class and inform the model
     * 
     * @param  \App\Models\Sale  $sale
     */
    public function __construct(Sale $sale)
    {
        parent::__construct($sale);
    }
}
