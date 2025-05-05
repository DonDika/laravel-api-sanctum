<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function getProduct()
    {
        $data = Product::orderBy('id', 'asc')->get();

        return response()->json([
            'error' => false,
            'message' => 'Data berhasil ditemukan',
            'data' => $data
        ],200);
    }

}
