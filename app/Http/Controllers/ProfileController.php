<?php

namespace App\Http\Controllers;

use App\Models\Profiles;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
     public function load(){
        $profiles = \App\Models\Profiles::where('id',1)->get();
        return $this->responseSuccess('profile loaded successfully', $profiles[0]);
    }

    public function upload(Request $request){
        if ($request->hasFile('logo')) {
           
           
            $path = $request->file('logo')->store('logo', 'public');
             
            $profiles = Profiles::find(1);

            $profiles->logo = $path;

            $profiles->save();

            return $this->responseSuccess('logo upload successfully', [
                'filename'=> $path
            ]);
        }
    }

    public function save(Request $request){
        $profiles = Profiles::find(1);

        $profiles->name = $request->input('name');
        $profiles->address = $request->input('address');
        $profiles->email = $request->input('email');
        $profiles->description = $request->input('description');
        $profiles->hp = $request->input('hp');

        $profiles->save();


        return $this->responseSuccess('Profile saved successfully', null);
    }
}
