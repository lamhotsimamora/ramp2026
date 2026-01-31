<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NettoPetani extends Model
{
    protected $table = 'netto_petani';
    public $timestamps = true;

      protected $fillable = [
        'id_petani',
        'berat_mobil_sawit_bruto',
        'berat_mobil_kosong_tara',
        'berat_total_sawit_netto',
        'date',
        'time'
    ];
}
