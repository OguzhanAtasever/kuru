<?php

namespace App\Http\Controllers;
use App\Models\Siparis;
use Cart;

use Illuminate\Http\Request;

class OdemeController extends Controller
{
    public function index(){
        if(!auth()->check())// kullanici girişi yapıldi mi ?=
        {
            return redirect()->route('kullanici.oturumac')
                ->with('mesaj_tur','infor')
                ->with('mesaj','Ödeme işlemi için ourum açmanız veya kullanici kaydi yapmaniz gerekmektedir');
        }
        else if(count(Cart::content())==0)
        {
            return redirect()->route('anasayfa')
                ->with('mesaj_tur','info')
                ->with('mesaj','Ödeme işlemi için sepetinizde bir ürün bulunmalıdır');
        }
        $kullanici_detay = auth()->user()->detay; //detay kullanici modelde tanımlı
        return view('payment',compact('kullanici_detay'));
    }
    public function odemeyap(){
        $siparis = request()->all();
        $siparis['sepet_id'] = session('aktif_sepet_id');
        $siperis['banka'] = "Garanti";
        $siparis['taksit_sayisi']  = 1;
        $siparis['durum'] = "Siparis Alındı";
        $siparis['siparis_tutari'] = Cart::subtotal();

        Siparis::create($siparis);


        Cart::destroy();
        session()->forget('aktif_sepet_id');

        return redirect()->route('siparisler')
            ->with('mesaj_tur','success')
            ->with('mesaj','Ödeme başarılı bir şekilde gerçekleştirildi');
    }
}
