<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petani extends Model
{
    protected $table = 'petani';
    public $timestamps = true;

      protected $fillable = [
        'name',
        'address',
        'hp',
        'mobil_jenis',
        'plat_mobil'
    ];
}
