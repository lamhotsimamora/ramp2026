<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function load(){
        $transaction = \App\Models\ViewTransactions::orderBy('id','desc')->get();
        return $this->responseSuccess('transaction loaded successfully', $transaction);
    }

    public function delete(Request $request){
        $transaction =   \App\Models\Transactions::find($request->id);

        $transaction->delete();

        return $this->responseSuccess('transaction delete successfully',null);
    }

    public function totalLoad(){
        $today = Transactions::whereDate('created_at', today());
        $week  = Transactions::whereBetween('created_at', [now()->startOfWeek(), now()]);
        $month = Transactions::whereMonth('created_at', now()->month);

         return $this->responseSuccess('Setting loaded successfully',[
        'today' => [
            'total' => $today->sum('total_money'),
            'count' => $today->count()
        ],
        'week' => [
            'total' => $week->sum('total_money'),
            'count' => $week->count()
        ],
        'month' => [
            'total' => $month->sum('total_money'),
            'count' => $month->count()
        ],
        ]);
    }
}
