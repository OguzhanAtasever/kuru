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
        return view('kategori',compact('kategori','alt_kategoriler'));
    }
}
