<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Urun extends Model
{
    use SoftDeletes;

    protected $table ="urun"; //urun tablosu oluşturmayı sağlıyor s eki getirtmiyor

    protected $guarded =[];

    const CREATED_AT = 'olusturulma_tarihi';  //migration dosyasında düzeltilse de buradan bu ayarlamalar yapılmalı
    const UPDATED_AT = 'guncelleme_tarihi';
    const DELETED_AT = 'silinme_tarihi';

    //model olamadan çoka çok ilişki için kullanıldı
    public function kategoriler(){
        return $this->belongsToMany('App\Models\Kategori','kategori_uruns');
    }

    //urunun detay bilgilerine detay fonknuyla erişebileceğiz

    public function detay(){
        //hasone birebir ilişki yapısında verileri çekmemizi sağlayan yapıdır
        return $this->hasOne('App\Models\UrunDetay')->withDefault();
    }


}
