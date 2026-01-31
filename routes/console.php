<?php

use App\Models\Admins;
use App\Models\DailyPrices;
use App\Models\Petani;
use App\Models\Settings;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote');

Artisan::command('seed', function () {
    $password = md5('Qwezxc123');
    Admins::create([
        'username' => 'admin',
        'password' => $password
    ]);

    Petani::create([
        'name' => 'Petani 1',
        'hp' => '081234567890',
        'address' => 'Jl. Merdeka No. 1',
        'mobil_jenis'=> 'Truk',
        'plat_mobil'=> 'B 1234 CD',
    ]);

    Settings::create([
        'potongan_muat' => 20000,
        'potongan_persen' => 3,
    ]);

    DailyPrices::create([
        'price_daily' => 3090,
        'date_price' => date('Y-m-d'),
    ]);
})->purpose('');