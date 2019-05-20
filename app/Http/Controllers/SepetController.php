<?php

namespace App\Http\Controllers;

use App\Models\Sepet;
use App\Models\SepetUrun;
use App\Models\Urun;
use Cart;
use Collective\Html\FormFacade;
use Illuminate\Http\Request;
use Validator;

class SepetController extends Controller
{

    public function index(){
        return view('sepet');
    }

    public function ekle(){
        //formdan gelen id değerini request id sayesinde alıyoruz
        $urun = Urun::find(request('id'));  //bu id li ürün çekiliyor
        $cartItem = Cart::add($urun->id,$urun->urun_adi,1,$urun->fiyati, ['slug'=>$urun->slug] ); // buradaki 1 adet sayısını belirityor isimler değişik [] farklı değerler alma imkanı da var

        if(auth()->check())
        {
            $aktif_sepet_id = session('aktif_sepet_id');
            if(!isset($aktif_sepet_id))
            {
                $aktif_sepet = Sepet::create([
                    'kullanici_id'=> auth()->id()
                ]);
                $aktif_sepet_id = $aktif_sepet->id;
                session()->put('aktif_sepet_id',$aktif_sepet_id);
            }
            SepetUrun::updateOrCreate(
                ['sepet_id'=>$aktif_sepet_id,'urun_id'=>$urun->id],
                ['adet'=>$cartItem->qty,'tutar'=>$urun->fiyati,'durum'=>'Beklemede']
            );
        }

          return redirect()
            ->route('sepet')
            ->with('mesaj_tur','success')
            ->with('mesaj','Ürün sepete eklendi.');

    }

    public function kaldir($rowid){

        if(auth()->check())
        {
            $aktif_sepet_id = session('aktif_sepet_id');
            $cartItem = Cart::get($rowid); //verilen sepetteki row id yi gerçek id ye çeviriyor
            SepetUrun::where('sepet_id',$aktif_sepet_id)->where('urun_id',$cartItem->id)->delete();
        }

        Cart::remove($rowid);
        return redirect()
            ->route('sepet')
            ->with('mesaj_tur','success')
            ->with('mesaj','Ürün sepetten kaldırıldı.');
    }

    public function bosalt(){

        if(auth()->check())
        {
            $aktif_sepet_id = session('aktif_sepet_id');
            SepetUrun::where('sepet_id',$aktif_sepet_id)->delete();
        }

        Cart::destroy();

        return redirect()
            ->route('sepet')
            ->with('mesaj_tur','success')
            ->with('mesaj','Sepetiniz boşaltıldı.');

    }

    public function guncelle($rowid){

        $validator = Validator::make(request()->all(),[
            'adet'=>'required|numeric|between:0,5' //sınırlamalar gerçekleştiriliyor
        ]);
        if($validator->fails())
        {
            session()->flash('mesaj_tur','danger');
            session()->flash('mesaj','Adet degeri 0 ile 5 arasında olmalıdır.');
            return response()->json(['success'=>false]);
        }
        if(auth()->check())
        {
            $aktif_sepet_id = session('aktif_sepet_id');
            $cartItem = Cart::get($rowid);
            if(request('adet')==0) //adet bilgisi 0 sa siliyor değilse bulup güncelliyor
            SepetUrun::where('sepet_id',$aktif_sepet_id)
                ->where('urun_id',$cartItem->id)
                ->delete();
            else
            SepetUrun::where('sepet_id',$aktif_sepet_id)
                ->where('urun_id',$cartItem->id)
                ->update(['adet'=>request('adet')]);
        }

        Cart::update($rowid,request('adet'));
        session()->flash('mesaj_tur','success');
        session()->flash('mesaj','Adet bilgisi güncellendi');
        return response()->json(['success'=>true]);
    }
}
