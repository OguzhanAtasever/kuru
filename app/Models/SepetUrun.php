<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SepetUrun extends Model
{
    use SoftDeletes;
    protected $table = 'sepet_urun';
    protected $guarded = [];

    const CREATED_AT = 'olusturulma_tarihi';  //migration dosyasında düzeltilse de buradan bu ayarlamalar yapılmalı
    const UPDATED_AT = 'guncelleme_tarihi';
    const DELETED_AT = 'silinme_tarihi';

    public function urun()   //ilişkili tablo için
    {
        return $this->belongsTo('App\Models\Urun'); //ilişkili olan Urun tablosundaki veriye vererek onu urun fonksiyonuna veriyor
    }
}
