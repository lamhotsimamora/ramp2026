<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
     public function load(){
        $profiles = \App\Models\Profiles::where('id',1)->get();
        return $this->responseSuccess('profile loaded successfully', $profiles[0]);
    }

    public function save(Request $request){
          \App\Models\Profiles::create([
            'name' => $request->name,
            'hp' => $request->hp,
            'address' => $request->address,
            'email'=> $request->email,
            'description'=> $request->description,
            'logo'=> $request->logo,
        ]);
        return $this->responseSuccess('Profile saved successfully', null);
    }
}
