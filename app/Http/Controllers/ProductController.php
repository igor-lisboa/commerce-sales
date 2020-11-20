<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product as RequestsProduct;
use App\Http\Requests\ProductStock;
use App\Models\Product;
use App\Services\ProductService;
use App\Services\ProductStockService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;
    private $productStockService;

    public function __construct(ProductService $productService, ProductStockService $producStockService)
    {
        $this->productService = $productService;
        $this->productStockService = $producStockService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if the logged user isn't one manager redirect to home
        if (auth()->user()->manager == null) {
            return redirect()->route('home');
        }
        return view('product.index', ['products' => $this->productService->index(5, 'page', $request->page ?? 1)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestsProduct $request)
    {
        $this->productService->store($request->validated());
        return redirect()->route('product.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.form', ['product' => $product]);
    }

    public function stockAdd(ProductStock $request)
    {
        $this->productStockService->store($request->validated());
        return redirect()->route('product.edit', [$request->product_id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(RequestsProduct $request, Product $product)
    {
        $this->productService->setModel($product);
        $this->productService->update($request->validated());
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        // set the product model as product service's model 
        $this->productService->setModel($product);

        // destroy from db this product register
        $this->productService->destroy();

        // redirect back to product index page
        return redirect()->route('product.index');
    }
}
