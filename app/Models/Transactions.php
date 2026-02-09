<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $table = 'transaction';
    public $timestamps = true;

      protected $fillable = [
        'inv',
        'id_petani',
        'id_daily_price',
        'id_netto_petani',
        'date',
        'time',
        'total_money',
        'type_payment',
    ];
}
