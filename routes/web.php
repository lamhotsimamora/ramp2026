<?php

use App\Models\Profiles;
use App\Models\Settings;
use App\Models\ViewTransactions;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/print/nota/{id}',function($id){
    
    // get profile
    $profile = Profiles::where('id', 1)->get();

    // get transaction
    $transaction = ViewTransactions::where('id', $id)->get();

    $setting = Settings::where('id',1)->get();


    $data = array(
        'id' => $id,
        'profile' => $profile[0],
        'transaction' => $transaction[0],
        'setting' => $setting[0]
    );

    return view('invoice', ($data));
});