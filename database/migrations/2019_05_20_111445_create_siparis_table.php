<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiparisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siparis', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('sepet_id')->unsigned();
            $table->decimal('siparis_tutari',10,4);
            $table->string('durum',30)->nullable();

            $table->string('adsoyad',50)->nullable();
            $table->string('adres',200)->nullable();
            $table->string('telefon',15)->nullable();
            $table->string('ceptelefonu',15)->nullable();
            $table->string('banka',20)->nullable();
            $table->integer('taksit_sayisi')->nullable();

            $table->timestamp('olusturulma_tarihi')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('guncelleme_tarihi')->default(DB::raw('CURRENT_TIMESTAMP on UPDATE CURRENT_TIMESTAMP'));

            $table->timestamp('silinme_tarihi')->nullable();
            //bu özellik otomatik olarak veritabanında deleted_at isimli kolonu oluşturur(silinme tarihi)

            $table->unique('sepet_id');
            $table->foreign('sepet_id')->references('id')->on('sepet')->onDelete('cascade');
            $table->engine='InnoDB';

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siparis');
    }
}
