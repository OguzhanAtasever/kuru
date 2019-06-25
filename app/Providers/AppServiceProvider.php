<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Siparis;
use Illuminate\Support\Facades\Cache;
use App\Models\Kullanici;
use App\Models\Urun;
use App\Models\Kategori;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
       /* Schema::defaultStringLength(191);
        $bitisZamani=now()->addMinutes(10);
        $istatistik = Cache::remember('istatistikler' , $bitisZamani , function(){
                return[
                    'bekleyen_siparis'=>Siparis::where('durum','Siparişiniz alındı')->count()
                ];
        });
        View::share('istatistik',$istatistik);*/

        //kullanacagımız view dosyalarını burada tanımlıyoruz(tüm view dosyaları old için *)
        View::composer(['yonetim.*'] , function($view){
          
        $bitisZamani=now()->addMinutes(10);
        $istatistik = Cache::remember('istatistikler' , $bitisZamani , function(){
                return[
                    'bekleyen_siparis'=>Siparis::where('durum','Siparişiniz alındı')->count(),
                    'tamamlanan_siparis'=>Siparis::where('durum','Siparişiniz tamamlandı')->count(),
                    'toplam_urun'=>Urun::count(),
                    'toplam_kullanici'=>Kategori::count(),
                    'toplam_kategori'=>Kullanici::count()

                    
                ];
             });
             $view->with('istatistik',$istatistik);
        });
        
    }
}
