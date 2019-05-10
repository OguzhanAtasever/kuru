<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UrunController extends Controller
{
    public function index($lug_urunadi){
       return view('/urun');
    }
}
