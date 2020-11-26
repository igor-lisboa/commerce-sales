<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ProductExchange;
use App\Models\SaleProduct;
use App\Services\ProductExchangeService;
use Exception;
use Illuminate\Http\Request;

class ProductExchangeController extends Controller
{
    private $productExchangeService;

    public function __construct(ProductExchangeService $productExchangeService)
    {
        $this->productExchangeService = $productExchangeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('product-exchange.index', ['productExchanges' => $this->productExchangeService->index(5, 'page', $request->page ?? 1)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product-exchange.create', ['clients' => Client::orderBy('cpf')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            try {
                $saleProduct = SaleProduct::findOrFail($request->sale_product_id);
                $client = Client::findOrFail($request->client_id);
            } catch (Exception $x) {
                throw new Exception(__('msg_product_not_found'));
            }
            if ($saleProduct->sale->client->id != $client->id) {
                throw new Exception(__('msg_this_product_dnt_belongs_from_client'));
            }
            ProductExchange::create(['client_id' => $request->client_id, 'sale_product_id' => $request->sale_product_id, 'user_id' => auth()->user()->id]);
            return redirect()->route('product-exchange.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }
}
