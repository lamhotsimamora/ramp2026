<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function load(){
        $transaction = \App\Models\ViewTransactions::orderBy('id','desc')->get();
        return $this->responseSuccess('transaction loaded successfully', $transaction);
    }
}
