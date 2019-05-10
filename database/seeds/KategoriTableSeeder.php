<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //db sınıfı kullanıldığı için bu tanımlandı


class KategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategori')->truncate(); //seed çalıştırılınca tablodaki tüm verileri silecek

        $id = DB::table('kategori')->insertGetId(['kategori_adi'=>'Manav','slug'=>'manav']);
        DB::table('kategori')->insert(['kategori_adi'=>'Sebze','slug'=>'sebze','ust_id'=>$id]);
        DB::table('kategori')->insert(['kategori_adi'=>'Meyve','slug'=>'meyve','ust_id'=>$id]);

        $id = DB::table('kategori')->insertGetId(['kategori_adi'=>'Gıda ve İçecek','slug'=>'gida-icecek']);
        DB::table('kategori')->insert(['kategori_adi'=>'İçeçek','slug'=>'icecek','ust_id'=>$id]);
        DB::table('kategori')->insert(['kategori_adi'=>'Yağ','slug'=>'yag','ust_id'=>$id]);
        DB::table('kategori')->insert(['kategori_adi'=>'Şeker Baharat Tuz','slug'=>'seker-baharat-tuz','ust_id'=>$id]);
        DB::table('kategori')->insert(['kategori_adi'=>'Kahvaltılık Atıştırmalık','slug'=>'kahvaltilik-atistirmalik','ust_id'=>$id]);
        DB::table('kategori')->insert(['kategori_adi'=>'Hazır Yemek ve Konserve','slug'=>'hazir-yemek-konserve','ust_id'=>$id]);
        DB::table('kategori')->insert(['kategori_adi'=>'Makarna ve Sos','slug'=>'makarna-sos','ust_id'=>$id]);
        DB::table('kategori')->insert(['kategori_adi'=>'Bakliyat ve Un','slug'=>'bakliyat-un','ust_id'=>$id]);
        DB::table('kategori')->insert(['kategori_adi'=>'Organik Ürünler','slug'=>'organik-urunler','ust_id'=>$id]);

        $id = DB::table('kategori')->insertGetId(['kategori_adi'=>'Deterjan ve Temizlik','slug'=>'deterjan-temizlik']);
        DB::table('kategori')->insert(['kategori_adi'=>'Çamaşır Yıkama','slug'=>'camasir-yikama','ust_id'=>$id]);
        DB::table('kategori')->insert(['kategori_adi'=>'Bulaşık Yıkama','slug'=>'bulasik-yikama','ust_id'=>$id]);
        DB::table('kategori')->insert(['kategori_adi'=>'Ev Temiliği','slug'=>'ev-temizligi','ust_id'=>$id]);
        DB::table('kategori')->insert(['kategori_adi'=>'Peçete ve Tuvalet Kağıtları','slug'=>'pecete-tuvalet-kagidi','ust_id'=>$id]);

        $id = DB::table('kategori')->insertGetId(['kategori_adi'=>'Bebek','slug'=>'bebek']);
        DB::table('kategori')->insert(['kategori_adi'=>'Bez ve Islak Mendil','slug'=>'bez-islak-mendil','ust_id'=>$id]);
        DB::table('kategori')->insert(['kategori_adi'=>'Beslenme','slug'=>'beslenme','ust_id'=>$id]);
        DB::table('kategori')->insert(['kategori_adi'=>'Emzirme','slug'=>'emzirme','ust_id'=>$id]);
        DB::table('kategori')->insert(['kategori_adi'=>'Bebek Telsizi','slug'=>'bebek-telsizi','ust_id'=>$id]);
        DB::table('kategori')->insert(['kategori_adi'=>'Taşıma Ürünleri','slug'=>'tasima-urunleri','ust_id'=>$id]);
        DB::table('kategori')->insert(['kategori_adi'=>'Banyo Tuvalet','slug'=>'banyo-tuvalet','ust_id'=>$id]);
        DB::table('kategori')->insert(['kategori_adi'=>'Bakım Sağlık','slug'=>'bakim-saglik','ust_id'=>$id]);

        //$id = DB::table('kategori')->insertGetId(['kategori_adi'=>'Deterjan ve Temizlik','slug'=>'deterjan-temizlik']);




    }
}
