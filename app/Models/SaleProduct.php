<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleProduct extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sale_id',
        'product_id',
        'price_cents',
        'quantity',
    ];

    public function sale()
    {
        return $this->belongsTo('\App\Models\Sale');
    }

    public function product()
    {
        return $this->belongsTo('\App\Models\Product');
    }

    public function getPriceAttribute()
    {
        return number_format($this->price_cents / 100, 2, '.', '');
    }

    public function getTotalPriceCentsAttribute()
    {
        return $this->price_cents * $this->quantity;
    }

    public function getTotalPriceAttribute()
    {
        return number_format($this->getTotalPriceCentsAttribute() / 100, 2, '.', '');
    }
}
