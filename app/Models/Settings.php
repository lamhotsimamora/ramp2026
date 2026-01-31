<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = 'setting';
    public $timestamps = true;

      protected $fillable = [
        'potongan_muat',
        'potongan_persen',
    ];
}
