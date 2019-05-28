<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(KategoriTableSeeder::class); //kategori seeder ı çağırılarak burada bir yerlere ulaştırılıyor
        $this->call(UrunTableSeeder::class);
        $this->call(KullaniciTableSeeder::class);
    }
}
