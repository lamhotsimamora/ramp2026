<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotaController extends Controller
{
    public function save(Request $request){
        $netto_petani =  \App\Models\NettoPetani::create([
            'id_petani' => $request->id_petani['id'],
            'berat_mobil_sawit_bruto'=>$request->bruto,
            'berat_mobil_kosong_tara'=>$request->tara,
            'berat_total_sawit_netto'=>$request->netto
        ]);
        $id_netto_petani = $netto_petani->id;

        $transaction =  \App\Models\Transactions::create([
            'inv' => $this->generateInvoice(),
            'id_petani' => $request->id_petani['id'],
            'id_daily_price' =>$request->id_price_daily,
            'id_netto_petani' => $id_netto_petani,
            'total_money'=> $request->total_money,
            'type_payment'=>'Cash'
        ]);

        return $this->responseSuccess('Transactions saved successfully', null);     
    }

    private function generateInvoice(){
         $date = now()->format('Ymd'); // 20260209
        $random = strtoupper(substr(bin2hex(random_bytes(4)), 0, 6)); // 6 char random

        return "INV-{$date}-{$random}";
    }
}
