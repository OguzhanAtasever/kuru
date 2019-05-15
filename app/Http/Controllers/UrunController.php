<?php

namespace App\Http\Controllers;

use App\Models\Urun;
use Illuminate\Http\Request;

class UrunController extends Controller
{
    public function index($slug_urunadi){
        $urun = Urun::whereSlug($slug_urunadi)->firstOrFail();
        $kategoriler = $urun->kategoriler()->distinct()->get();

       return view('/urun',compact('urun','kategoriler'));
    }
    public function ara(){

        $aranan = request()->input('aranan'); //request içerisinden inputlar alınıyor
        $urunler = Urun::where('urun_adi','like',"%$aranan%")
            ->orWhere('aciklama','like',"%$aranan%")
            ->paginate(3); //get kullanılmıyor

        request()->flash(); //arama barındaki eki değeri tutmak için daha sonra  {{ old ('aranan ) şeklinde olacak
        return view('arama',compact('urunler'));
    }
}
