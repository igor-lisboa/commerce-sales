<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function getPriceCentsAttribute($value)
    {
        return number_format($value / 100, 2, '.', '');
    }

    public function getPriceCentsPromotionAttribute($value)
    {
        return number_format($value / 100, 2, '.', '');
    }

    public function setPriceCentsAttribute($value)
    {
        $this->attributes['price_cents'] = $value * 100;
    }

    public function setPriceCentsPromotionAttribute($value)
    {
        $this->attributes['price_cents_promotion'] = $value * 100;
    }
}
