<?php

namespace App\Http\Controllers;

use App\Models\Urun;
use Cart;
use Collective\Html\FormFacade;
use Illuminate\Http\Request;

class SepetController extends Controller
{

    public function index(){
        return view('sepet');
    }
    public function ekle(){
        //formdan gelen id değerini request id sayesinde alıyoruz
        $urun = Urun::find(request('id'));  //bu id li ürün çekiliyor

        Cart::add($urun->id,$urun->urun_adi,1,$urun->fiyati, ['slug'=>$urun->slug] ); // buradaki 1 adet sayısını belirityor isimler değişik [] farklı değerler alma imkanı da var
        return redirect()
            ->route('sepet')
            ->with('mesaj_tur','success')
            ->with('mesaj','Ürün sepete eklendi.');

    }


    public function kaldir($rowid){
        Cart::remove($rowid);
        return redirect()
            ->route('sepet')
            ->with('mesaj_tur','success')
            ->with('mesaj','Ürün sepetten kaldırıldı.');
    }
    public function bosalt(){
        Cart::destroy();

        return redirect()
            ->route('sepet')
            ->with('mesaj_tur','success')
            ->with('mesaj','Sepetiniz boşaltıldı.');

    }
}
