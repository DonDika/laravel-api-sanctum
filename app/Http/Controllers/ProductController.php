<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    
    public function getProduct()
    {
        $data = Product::orderBy('id', 'desc')->get();

        return response()->json([
            'error' => false,
            'message' => 'Data berhasil ditemukan',
            'data' => $data
        ],200);
    }


    public function postProduct(Request $request) 
    {
        $data = new Product();

        //rules
        $rules = [
            'name' => 'required',
            'price' => 'required',
            'description' => 'required'
        ];

        //validate data
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json([
                'error' => true,
                'message' => 'gagal memasukkan data',
                'data' => $validator->errors()
            ], 401);
        }

        //input data to db
        $data->name = $request->name;
        $data->price = $request->price;
        $data->description = $request->description;
        $data->save();

        return response()->json([
            'error' => false,
            'message' => 'data berhasil ditambahkan'
        ], 200);

    }



}
