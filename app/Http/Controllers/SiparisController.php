<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiparisController extends Controller
{
    public function index(){
        return view('siparisler');
    }
    public function detay($id){
        return view('siparisler'); // id değerine göre siparislerin ne olduğunu görmemizi sağlayacak
    }
}
