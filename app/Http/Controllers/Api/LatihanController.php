<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Latihan;

class LatihanController extends Controller
{
    public function index()
    {
        $latihans=Latihan::all();

        if(count($latihans)>0) {
            return response([
                'message' => 'Retrieve All Success',
                'latihan' => $latihans
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'latihan' => null
        ], 400);
    }

    public function show($id)
    {
        $latihan = Latihan::find($id);

        if(!is_null($latihan)) {
            return response([
                'message' => 'Retrieve Latihan Success',
                'latihan' => $latihan
            ], 200);
        }

        return response([
            'message' => 'Latihan Not Found',
            'latihan' => null
        ], 404);
    }

    public function store(Request $request)
    {
        $storeData=$request->all();
        $validate=Validator::make($storeData, [
            'alfabet' => 'required|max:1|regex:/^[a-zA-Z]+$/u',
            'nama' => 'required',
            'urlgambar' => 'required'
        ]);
        
        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $latihan=Latihan::create($storeData);
        return response([
            'message' => 'Add Latihan Success',
            'latihan' => $latihan
        ], 200);
    }

    public function destroy($id)
    {
        $latihan = Latihan::find($id);

        if(is_null($latihan)) {
            return response([
                'message' => 'Latihan Not Found',
                'latihan' => null
            ], 404);
        }

        if($latihan->delete()) {
            return response([
                'message' => 'Delete Latihan Success',
                'latihan' => $latihan
            ], 200); 
        }

        return response([
            'message' => 'Delete Latihan Failed',
            'latihan' => null,
        ], 400);
    }

    public function update(Request $request, $id)
    {
        $latihan=Latihan::find($id);
        if(is_null($latihan)) {
            return response([
                'message' => 'Latihan Not Found',
                'latihan' => null
            ], 404);
        }

        $updateData=$request->all();
        $validate=Validator::make($updateData, [
            'alfabet' => 'required|max:1|regex:/^[a-zA-Z]+$/u',
            'nama' => 'required',
            'urlgambar' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $latihan->alfabet=$updateData['alfabet'];
        $latihan->nama=$updateData['nama'];
        $latihan->urlgambar=$updateData['urlgambar'];

        if($latihan->save()) {
            return response([
                'message' => 'Update Latihan Success',
                'latihan' => $latihan
            ], 200);
        }

        return response([
            'message' => 'Update Latihan Failed',
            'latihan' => null,
        ], 400);
    }
}
