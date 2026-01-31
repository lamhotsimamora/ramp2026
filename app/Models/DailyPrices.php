<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyPrices extends Model
{
    protected $table = 'daily_prices';
    public $timestamps = true;

      protected $fillable = [
        'date_price',
        'price_daily'
    ];
}
