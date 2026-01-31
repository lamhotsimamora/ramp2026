<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profiles extends Model
{
    protected $table = 'profile';
    public $timestamps = true;

      protected $fillable = [
        'name',
        'address',
        'email',
        'description',
        'hp',
        'logo'
    ];
}
