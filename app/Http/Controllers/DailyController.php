<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DailyController extends Controller
{
    public function load(Request $request)
    {
        $dailyPrices = \App\Models\DailyPrices::first();
        return $this->responseSuccess('Daily prices loaded successfully', $dailyPrices);
    }

    public function save(Request $request)
    {
        $dailyPrices = \App\Models\DailyPrices::first();
        if (!$dailyPrices) {
            return $this->responseError('Daily prices not found', null);
        }

        $dailyPrices->price_daily = $request->price_daily;
        $dailyPrices->date_price = $request->date_price;
        $dailyPrices->save();

        return $this->responseSuccess('Daily prices updated successfully', null);
    }
}
