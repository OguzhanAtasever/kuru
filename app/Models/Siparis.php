<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siparis extends Model
{
    use SoftDeletes;

    protected $table = 'siparis';

    protected $fillable = ['sepet_id','siparis_tutari','adsoyad','adres','telefon','ceptelefonu','banka','taksit_sayisi','durum'];//sadece ekleneblicek yerleri belirliyoruz

    const CREATED_AT = 'olusturulma_tarihi';  //migration dosyasında düzeltilse de buradan bu ayarlamalar yapılmalı
    const UPDATED_AT = 'guncelleme_tarihi';
    const DELETED_AT = 'silinme_tarihi';

    public function sepet()// doğrudan siparişten sepet dosyasına erişim için
    {
        return  $this->belongsTo('App\Models\Sepet');
    }
}
