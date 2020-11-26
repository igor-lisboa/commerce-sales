<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductExchange extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'sale_product_id',
        'user_id',
    ];

    public function client()
    {
        return $this->belongsTo('\App\Models\Client');
    }

    public function sale_product()
    {
        return $this->belongsTo('\App\Models\SaleProduct');
    }
}
