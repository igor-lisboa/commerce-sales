<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'client_id',
        'payment_method_id',
        'canceled',
        'amount_paid_cents',
        'change_paid_cents'
    ];

    public function user()
    {
        return $this->belongsTo('\App\Models\User');
    }

    public function client()
    {
        return $this->belongsTo('\App\Models\Client');
    }

    public function method()
    {
        return $this->belongsTo('\App\Models\PaymentMethod');
    }

    public function getStatusAttribute()
    {
        if ($this->canceled) {
            return __("Canceled");
        } else {
            if ($this->amount_paid_cents) {
                return __("Finished");
            } else {
                if ($this->payment_method_id) {
                    return __("Payment method chosen");
                } else {
                    return __("Opened");
                }
            }
        }
    }

    public function getTotalAmountCentsAttribute()
    {
        return $this->products()->select(DB::raw('sum(price_cents * quantity) as total'))->pluck('total')[0] ?? 0;
    }

    public function getTotalAmountAttribute()
    {
        return number_format($this->total_amount_cents / 100, 2, '.', '');
    }

    public function getChangeCentsAttribute()
    {
        return $this->amount_paid_cents - $this->getTotalDueCentsAttribute();
    }

    public function getTotalDueCentsAttribute()
    {
        return $this->getTotalAmountCentsAttribute() - $this->used_points;
    }

    public function products()
    {
        return $this->hasMany('\App\Models\SaleProduct');
    }
}
