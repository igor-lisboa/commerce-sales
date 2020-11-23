<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
