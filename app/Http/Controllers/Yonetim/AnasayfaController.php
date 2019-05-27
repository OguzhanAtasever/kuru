<?php

namespace App\Http\Controllers\Yonetim;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnasayfaController extends Controller
{
    
   public function index(){
   		//view dosyasına fonknu gönderme işlemide views klasörünün içindeki yonetim klasöründeki oturumac.blade.php dosyasına oturumac fonknunu gönder
   		return view('yonetim.layouts.anasayfa');
   }
}
