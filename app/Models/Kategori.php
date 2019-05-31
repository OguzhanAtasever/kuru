<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use SoftDeletes;
    protected $table = "kategori";
    //protected $fillable = ['kategori_adi','slug'];
    protected $guarded = []; //belirlenen bir kolonu veritabanına eklemesin istemiyorsak
    //boş dizi olarak ayarlarsak veritabanına her türlü ekleme işlemi gerçekleştirilebilir
    const CREATED_AT = 'olusturulma_tarihi';  //migration dosyasında düzeltilse de buradan bu ayarlamalar yapılmalı
    const UPDATED_AT = 'guncelleme_tarihi';
    const DELETED_AT = 'silinme_tarihi';


    //model içerisinde doğrudan ürnleri çekebilen fonksiyon
    public function urunler(){
        return $this->belongsToMany('App\Models\Urun','kategori_uruns');
    }
 
    public function ust_kategori(){
        return $this->belongsTo('App\Models\Kategori','ust_id')->withDefault([

             'kategori_adi'=>'Ana Kategori'
        ]);
    }

}
