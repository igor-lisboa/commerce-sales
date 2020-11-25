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
        'used_points'
    ];

    public function user()
    {
        return $this->belongsTo('\App\Models\User');
    }

    public function client()
    {
        return $this->belongsTo('\App\Models\Client');
    }

    public function payment_method()
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
        $changeCents = $this->amount_paid_cents - $this->getTotalDueCentsAttribute();
        if ($changeCents > 0) {
            return $changeCents;
        } else {
            return 0;
        }
    }

    public function getAmountPaidAttribute()
    {
        return number_format($this->amount_paid_cents / 100, 2, '.', '');
    }

    public function getChangeAttribute()
    {
        return number_format($this->getChangeCentsAttribute() / 100, 2, '.', '');
    }

    public function getTotalDueCentsAttribute()
    {
        return $this->getTotalAmountCentsAttribute() - $this->used_points;
    }

    public function getTotalDueAttribute()
    {
        return number_format($this->total_due_cents / 100, 2, '.', '');
    }

    public function products()
    {
        return $this->hasMany('\App\Models\SaleProduct');
    }
}
