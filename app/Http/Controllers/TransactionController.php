<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function load(){
         $transaction = \App\Models\ViewTransactions::all();
        return $this->responseSuccess('transaction loaded successfully', $transaction);
    }
}
