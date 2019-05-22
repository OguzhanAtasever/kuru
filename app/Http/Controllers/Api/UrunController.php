<?php

namespace App\Http\Controllers\Api;

use App\Models\Urun;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UrunController extends Controller
{
    public function urunler()
    {
        $urunler = Urun::all();
        return response()->json($urunler);
    }
}
