<?php

namespace App\Services;

use App\Models\Product;

class ProductService extends BaseService
{
    /**
     * 
     * Init the class and inform the model
     * 
     * @param  \App\Models\Product  $product
     */
    public function __construct(Product $product)
    {
        parent::__construct($product);
    }
}
