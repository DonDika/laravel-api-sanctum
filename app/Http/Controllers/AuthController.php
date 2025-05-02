<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function registerUser (Request $request)
    {
        $dataUser = new User();
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email', //mencari di tabel users, kolom email
            'password' => 'required'

        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json([
                'status' => 'false',
                'message' => 'proses validasi gagal',
                'data' => $validator->errors()
            ],401);
        }

        $dataUser->name = $request->name;
        $dataUser->email = $request->email;
        $dataUser->password = Hash::make($request->password);
        $dataUser->save();

        return response()->json([
            'status' => 'true',
            'message' => 'berhasil mendaftar'
        ],201);

    }

}