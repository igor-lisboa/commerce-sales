<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleProduct as RequestsSaleProduct;
use App\Models\Sale;
use App\Models\SaleProduct;
use App\Services\SaleProductService;
use Illuminate\Http\Request;

class SaleProductController extends Controller
{
    private $saleProductService;

    public function __construct(SaleProductService $saleProductService)
    {
        $this->saleProductService = $saleProductService;
        $this->middleware('is.manager')->only(['update', 'destroy']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SaleProduct  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function store(RequestsSaleProduct $request, Sale $sale)
    {
        $this->saleProductService->storeSaleProduct($request->validated(), $sale);
        return redirect()->route('sale.edit', [$sale]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SaleProduct  $request
     * @param  \App\Models\SaleProduct  $saleProduct
     * @return \Illuminate\Http\Response
     */
    public function update(RequestsSaleProduct $request, SaleProduct $saleProduct)
    {
        $this->saleProductService->updateSaleProduct($request->validated(), $saleProduct);
        return redirect()->route('sale.edit', [$request->sale]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SaleProduct  $saleProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, SaleProduct $saleProduct)
    {
        $this->saleProductService->setModel($saleProduct);
        $this->saleProductService->destroy();
        return redirect()->route('sale.edit', [$request->sale]);
    }
}
