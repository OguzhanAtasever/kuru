<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index($slug_kategoriadi)
    {
        $kategori = Kategori::where('slug',$slug_kategoriadi)->firstOrFail();  //en üstteki yani üst id si null olanlar asıl kaegori
        $alt_kategoriler = Kategori::where('ust_id',$kategori->id)->get(); //slug değeri ille gönderilen kategorinin üst idisi ile eşit olanlar

        $order = request('order'); //sıralama için gönderilen order alınıyor
        if($order =='coksatanlar'){
            $urunler = $kategori->urunler()
                ->join('urun_detay','urun_detay.urun_id','urun.id')
                ->orderBy('urun_detay.goster_cok_satan','desc')
                ->paginate(2);
        }
        else if($order == 'yeni'){
            $urunler = $kategori->urunler()->distinct()->orderByDesc('guncelleme_tarihi')->paginate(2);
        }
        else if($order == 'artanfiyat'){
            $urunler = $kategori->urunler()->distinct()->orderBy('fiyati')->paginate(2);
        }
        else if($order == 'azalanfiyat'){
            $urunler = $kategori->urunler()->distinct()->orderByDesc('fiyati')->paginate(2);
        }
        else{
            $urunler = $kategori->urunler()->distinct()->paginate(2); //kategpri.php ile gönderilen verileri bu şekilde çekiyoruz
        }


        return view('kategori',compact('kategori','alt_kategoriler','urunler'));
    }

}
