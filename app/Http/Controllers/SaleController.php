<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleCreate;
use App\Http\Requests\SaleSetPaymentMethod;
use App\Models\Client;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Sale;
use App\Services\SaleService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return view('sale.create', ['clients' => Client::orderBy('cpf')->get()]);
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
        if ($sale->status == __("Opened") || $sale->status == __("Payment method chosen")) {
            return view('sale.edit', ['sale' => $sale, 'products' => Product::whereNotIn('id', $sale->products()->pluck('product_id'))->get(), 'paymentMethods' => PaymentMethod::get()]);
        } else {
            return redirect()->route('sale.index');
        }
    }

    public function confirm(Sale $sale)
    {
        if ($sale->status == __("Payment method chosen")) {
            return view('sale.confirm', ['sale' => $sale]);
        } else {
            return redirect()->route('sale.index');
        }
    }

    public function pay(Request $request, Sale $sale)
    {
        if ($sale->status == __("Payment method chosen")) {
            $amountPaidCents = 0;
            if ($sale->payment_method->can_have_change) {
                $amountPaidCents = $request->amount_paid_cents * 100;
            } else {
                $amountPaidCents = $sale->total_due_cents;
            }
            try {
                DB::beginTransaction();
                foreach ($sale->products as $saleProduct) {
                    $productStock = ProductStock::create([
                        'product_id' => $saleProduct->product_id,
                        'output' => $saleProduct->quantity,
                    ]);
                    if ($productStock->product->balance < 0) {
                        throw new Exception(__('msg_product_stock_balance_exception', ['product' => $productStock->product->name]));
                    }
                }
                $sale->update(['amount_paid_cents' => $amountPaidCents]);
                DB::commit();
                if ($sale->change_cents > 0) {
                    return redirect()->route('sale_change', [$sale]);
                } else {
                    return redirect()->route('sale.index');
                }
            } catch (Exception $e) {
                DB::rollBack();
                return redirect()->back()->withErrors($e->getMessage())->withInput();
            }
        } else {
            return redirect()->route('sale.index');
        }
    }

    public function change(Sale $sale)
    {
        if ($sale->status == __("Finished")) {
            return view('sale.change', ['sale' => $sale]);
        } else {
            return redirect()->route('sale.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SaleSetPaymentMethod  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(SaleSetPaymentMethod $request, Sale $sale)
    {
        try {
            if ($sale->status == __("Opened") || $sale->status == __("Payment method chosen")) {
                if ($request->used_points > $sale->client->total_points) {
                    throw new Exception(__('msg_invalid_used_points'));
                }
                $this->saleService->setModel($sale);
                $this->saleService->update($request->validated());
                return redirect()->route('sale_confirm', [$sale]);
            } else {
                return redirect()->route('sale.index');
            }
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
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
