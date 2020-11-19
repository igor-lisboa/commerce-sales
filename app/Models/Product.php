<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function getPrice()
    {
        return number_format($this->price_cents / 100, 2, ',', '.');
    }

    public function getPricePromotion()
    {
        return number_format($this->price_cents_promotion / 100, 2, ',', '.');
    }
}
