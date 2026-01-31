<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetaniController extends Controller
{
     public function load(Request $request)
    {
        $petani = \App\Models\Petani::orderBy('id', 'desc')->get();
        return $this->responseSuccess('Petani loaded successfully', $petani);
    }

    public function save(Request $request)
    {
        // check if name is exist
        $exist = \App\Models\Petani::where('name', $request->name)->first();
        if ($exist) {
            return $this->responseError('Petani name already exists', null);
        }

        \App\Models\Petani::create([
            'name' => $request->name,
            'hp' => $request->hp,
            'address' => $request->address,
            'mobil_jenis'=> $request->mobil_jenis,
            'plat_mobil'=> $request->plat_mobil,
        ]);
        return $this->responseSuccess('Petani saved successfully', null);
    }

    public function update(Request $request){
         $petani = \App\Models\Petani::find($request->id);
        if (!$petani) {
            return $this->responseError('Petani not found', null);
        }

        $petani->name = $request->name;
        $petani->hp = $request->hp;
        $petani->address = $request->address;
        $petani->mobil_jenis = $request->mobil_jenis;
        $petani->plat_mobil = $request->plat_mobil;
        $petani->save();

        return $this->responseSuccess('Petani updated successfully', null);
    }

    public function delete(Request $request){
         $petani = \App\Models\Petani::find($request->id);
        if ($petani) {
            $petani->delete();
            return $this->responseSuccess('Petani deleted successfully', null);
        } else {
            return $this->responseError('Petani not found', null);
        }
    }

    public function search(Request $request){
        $keyword = $request->search;
        $petani = \App\Models\Petani::where('name', 'like', "%$keyword%")
            ->orWhere('address', 'like', "%$keyword%")
            ->orWhere('hp', 'like', "%$keyword%")
            ->orWhere('mobil_jenis', 'like', "%$keyword%")
            ->orWhere('plat_mobil', 'like', "%$keyword%")
            ->get();

        return $this->responseSuccess('Search completed successfully', $petani);
    }
}
