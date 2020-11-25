<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'preferential',
        'name',
        'email',
        'cpf',
        'identity',
        'address',
    ];

    public function complaints()
    {
        return $this->hasMany('App\Models\Complaint');
    }

    public function sales()
    {
        return $this->hasMany('App\Models\Sale');
    }

    public function getTotalPointsAttribute()
    {
        return $this->sales()->select(DB::raw('sum(amount_paid_cents) - sum(used_points) as total'))->pluck('total')[0] ?? 0;
    }
}
