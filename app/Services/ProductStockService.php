<?php

namespace App\Services;

use App\Models\ProductStock;

class ProductStockService extends BaseService
{
    /**
     * 
     * Init the class and inform the model
     * 
     * @param  \App\Models\ProductStock  $productStock
     */
    public function __construct(ProductStock $productStock)
    {
        parent::__construct($productStock);
    }
}
