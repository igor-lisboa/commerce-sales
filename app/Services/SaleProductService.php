<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleProduct;

class SaleProductService extends BaseService
{
    /**
     * 
     * Init the class and inform the model
     * 
     * @param  \App\Models\SaleProduct  $sale
     */
    public function __construct(SaleProduct $saleProduct)
    {
        parent::__construct($saleProduct);
    }

    public function getCentsOfSelectedProduct(Sale $sale, Product $product, int $quantity)
    {
        $productPriceCents = $product->price_cents;
        if ($sale->client->preferential) {
            if ($product->price_cents_promotion != 0 && $product->price_cents_promotion != null) {
                $productPriceCents = $product->price_cents_promotion;
            }
        }
        return  $productPriceCents;
    }

    public function storeSaleProduct(array $requestData, Sale $sale)
    {
        $requestData['sale_id'] = $sale->id;
        $requestData['price_cents'] = $this->getCentsOfSelectedProduct($sale, Product::findOrFail($requestData['product_id']), $requestData['quantity']);
        $this->store($requestData);
    }

    public function updateSaleProduct(array $requestData, SaleProduct $saleProduct)
    {
        $this->setModel($saleProduct);
        $requestData['price_cents'] = $this->getCentsOfSelectedProduct($saleProduct->sale, Product::findOrFail($saleProduct->product_id), $requestData['quantity']);
        $this->update($requestData);
    }
}
