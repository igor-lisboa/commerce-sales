<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price_cents',
        'price_cents_promotion',
        'bar_code',
        'provider',
    ];

    public function stock()
    {
        return $this->hasMany('\App\Models\ProductStock');
    }

    public function getBalanceAttribute()
    {
        return $this->stock()->select(DB::raw('sum(input) - sum(output) as stock'))->pluck('stock')[0] ?? 0;
    }

    public function getPriceAttribute()
    {
        return number_format($this->price_cents / 100, 2, '.', '');
    }

    public function getPricePromotionAttribute()
    {
        if ($this->price_cents_promotion != null) {
            return number_format($this->price_cents_promotion / 100, 2, '.', '');
        } else {
            return null;
        }
    }

    public function setPriceCentsAttribute($value)
    {
        $this->attributes['price_cents'] = $value * 100;
    }

    public function setPriceCentsPromotionAttribute($value)
    {
        if ($value != null) {
            $this->attributes['price_cents_promotion'] = $value * 100;
        }
    }
}
