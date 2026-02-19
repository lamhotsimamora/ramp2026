<?php

use App\Models\Profiles;
use App\Models\Settings;
use App\Models\ViewTransactions;
use Illuminate\Support\Facades\Route;

use Carbon\Carbon;
Route::get('/', function () {
    return view('welcome');
});


Route::get('/print/nota/{id}',function($id){
    
    // get profile
    $profile = Profiles::where('id', 1)->get();

    // get transaction
    $transaction = ViewTransactions::where('id', $id)->get();

   

    $url = asset('storage');


    $data = array(
        'id' => $id,
        'profile' => $profile[0],
        'transaction' => $transaction[0],
        'url' => $url,
        'type' => $transaction[0]->type
    );

    return view('invoice', ($data));
});

Route::get('/report/transaction/monthly', function () {
    $profile = Profiles::where('id', 1)->get();
    $transaction = ViewTransactions::whereMonth('created_at', date('m'))
        ->whereYear('created_at', date('Y'))
         ->orderBy('id','desc')
        ->get();

    $total_transaction = $transaction->sum('total_money');

    $data = array(
        'profile' => $profile[0],
        'transaction' => $transaction,
        'date' => date('M') . '-' . date('Y'),
        'now' => date('d-M-Y'),
        'total' => $total_transaction,
        'description'=> 'Monthly Sales Report'
    );
    return view('report', $data);
});

Route::get('/report/transaction/weekly', function () {
    $profile = Profiles::where('id', 1)->get();
     $transaction = ViewTransactions::whereBetween('created_at', [
        Carbon::now()->startOfWeek(), 
        Carbon::now()->endOfWeek()
    ])
     ->orderBy('id','desc')
    ->get();

    $total_transaction = $transaction->sum('total_money');


    $data = array(
        'profile' => $profile[0],
        'transaction' => $transaction,
        'date' => date('M') . '-' . date('Y'),
        'now' => date('d-M-Y'),
        'total' => $total_transaction,
        'description'=> 'Weekly Sales Report'
    );
    return view('report', $data);
});

Route::get('/report/transaction/daily', function () {
   
    $todayStart = Carbon::now()->startOfDay();
    $todayEnd   = Carbon::now()->endOfDay();

    $profile = Profiles::where('id', 1)->first();

    $transaction = ViewTransactions::whereBetween('created_at', [
            $todayStart,
            $todayEnd
        ])
        ->orderBy('id', 'desc')
        ->get();

    $total_transaction = $transaction->sum('total_money');

    $data = [
        'profile'     => $profile,
        'transaction' => $transaction,
        'date'        => date('d-M-Y'),
        'now'         => date('d-M-Y'),
        'total'       => $total_transaction,
        'description' => 'Daily Sales Report'
    ];

    return view('report', $data);
});