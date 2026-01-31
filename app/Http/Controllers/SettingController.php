<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function load(Request $request)
    {
        $setting = \App\Models\Settings::first();
        return $this->responseSuccess('Setting loaded successfully', $setting);
    }

    public function save(){
        $setting = \App\Models\Settings::first();
        if (!$setting) {
            return $this->responseError('Setting not found', null);
        }

        $setting->potongan_muat = request()->potongan_muat;
        $setting->potongan_persen = request()->potongan_persen;
        $setting->save();

        return $this->responseSuccess('Setting updated successfully', null);
    }
}
