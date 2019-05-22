<?php

namespace App\Http\Controllers\Api;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KategoriController extends Controller
{
    public function kategoriler()
    {
        $kategoriler = Kategori::all();
        return response()->json($kategoriler);
    }
}
