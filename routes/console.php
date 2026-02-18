<?php

use App\Models\Admins;
use App\Models\DailyPrices;
use App\Models\Petani;
use App\Models\Profiles;
use App\Models\Settings;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\HttpKernel\Profiler\Profile;

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
        'name' => 'Lamhot SImamora',
        'hp' => '081399453242',
        'address' => 'Sidodadi',
        'mobil_jenis'=> 'Carry',
        'plat_mobil'=> 'BH 8329 SG',
    ]);



    Profiles::create([
        'name' => 'Sidodadi Ramp',
        'address' => 'Sidodadi',
        'email'=>'sidodadi@gmail.com',
        'description' =>'NIB: 123456789',
        'hp' => '081212121212',
        'logo' => './img/no-image.png'
    ]);
})->purpose('');