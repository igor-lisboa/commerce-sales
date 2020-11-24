<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleCreate;
use App\Models\Client;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleProduct;
use App\Services\SaleService;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    private $saleService;

    public function __construct(SaleService $saleService)
    {
        $this->saleService = $saleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('sale.index', ['sales' => $this->saleService->index(5, 'page', $request->page ?? 1)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sale.form', ['clients' => Client::orderBy('cpf')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SaleCreate  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleCreate $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $sale = $this->saleService->store($data);
        return redirect()->route('sale.edit', [$sale]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        return view('sale.form', ['sale' => $sale, 'products' => Product::whereNotIn('id', $sale->products()->pluck('product_id'))->get()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        $this->saleService->setModel($sale);
        $this->saleService->update($request->validated());
        return redirect()->route('sale.edit', [$sale]);
    }

    /**
     * Show the profile for the given user.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\View\View
     */
    public function show(Sale $sale)
    {
        return view('sale.show', ['sale' => $sale]);
    }

    /**
     * Cancel the specified sale.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        $this->saleService->setModel($sale);
        $this->saleService->update(['canceled' => true]);
        return redirect()->route('sale.index');
    }
}
