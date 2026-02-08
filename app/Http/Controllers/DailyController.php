<?php

namespace App\Http\Controllers;

use App\Models\DailyPrices;
use Illuminate\Http\Request;

class DailyController extends Controller
{
    public function load(Request $request)
    {
        // select daily prices by date now
        $dailyPrices = \App\Models\DailyPrices::where('date_price', date('Y-m-d'))->first();
        return $this->responseSuccess('Daily prices loaded successfully', $dailyPrices);
    }

    public function save(Request $request)
    {
        // check daily_prices by date now if daily prices exist update else create new
        $dailyPrices = \App\Models\DailyPrices::where('date_price', date('Y-m-d'))->first();
        if ($dailyPrices) {
            $dailyPrices->price_daily = $request->price_daily;
            $dailyPrices->save();
        } else {
            \App\Models\DailyPrices::create([
                'price_daily' => $request->price_daily,
                'date_price' => date('Y-m-d'),      
            ]);

        }
    }
}
