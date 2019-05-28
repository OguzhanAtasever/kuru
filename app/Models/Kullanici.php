<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Kullanici extends Authenticatable
{
    use SoftDeletes;
    protected $table = "kullanici";
    //create komutu ile kullanılacak olan
    protected $fillable = ['adsoyad', 'email', 'sifre','aktivasyon_anahtari','aktif_mi','yonetici_mi'];

    //kullanıcının görmesini istemediğimiz alanlar
    protected $hidden = ['sifre', 'aktivasyon_anahtari' ];

    const CREATED_AT = 'olusturulma_tarihi';  //migration dosyasında düzeltilse de buradan bu ayarlamalar yapılmalı
    const UPDATED_AT = 'guncelleme_tarihi';
    const DELETED_AT = 'silinme_tarihi';

    public function  getAuthPassword()
    {
        return $this->sifre; // artık sifreyi kullanacak password değil

    }
    public function detay()// doğrudan siparişten sepet dosyasına erişim için
    {
        return  $this->hasOne('App\Models\KullaniciDetay')->withDefault();
    }


}
