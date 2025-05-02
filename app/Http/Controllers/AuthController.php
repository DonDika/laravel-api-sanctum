<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                'error' => true,
                'message' => 'proses validasi gagal',
                'data' => $validator->errors()
            ],401);
        }

        $dataUser->name = $request->name;
        $dataUser->email = $request->email;
        $dataUser->password = Hash::make($request->password);
        $dataUser->save();

        return response()->json([
            'error' => false,
            'message' => 'berhasil mendaftar'
        ],201);
    }


    public function loginUser(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json([
                'error' => true,
                'message' => 'proses login gagal',
                'dataa' => $validator->errors()
            ], 401);
        }

        if(!Auth::attempt($request->only(['email','password']))){
            return response()->json([
                'error' => 'true',
                'message' => 'email dan password yang dimasukkan tidak sesuai'
            ], 401);
        }


        $dataUser = User::where('email', $request->email)
                    ->first();
        return response()->json([
            'error' => false,
            'message' => 'berhasil login',
            'token' => $dataUser->createToken('api-product')->plainTextToken
        ], 200);



    }



}