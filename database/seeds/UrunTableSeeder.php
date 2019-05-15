<?php

use Illuminate\Database\Seeder;
use App\Models\Urun; //urun sınıfını kullanabilmek için eklenmeli
use App\Models\UrunDetay; //urun sınıfını kullanabilmek için eklenmeli

class UrunTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Urun::truncate(); //urun tablosu boşaltıldı

        UrunDetay::truncate();
        for ($i = 0; $i < 1000; $i++){

            $urun_adi = $faker->sentence(2);

            $urun = Urun::create([
                'urun_adi' => $urun_adi,
                'slug' => str_slug($urun_adi),
                'aciklama' => $faker->sentence(20),
                'fiyati' => $faker->randomFloat(3,1,20)

            ]);
            $detay = $urun->detay()->create([
                'goster_slider'=>rand(0,1),
                'goster_gunun_firsati'=>rand(0,1),
                'goster_one_cikan'=>rand(0,1),
                'goster_cok_satan'=>rand(0,1),
                'goster_indirimli'=>rand(0,1),
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
