<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHamKayitlarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ham_kayitlar', function (Blueprint $table) {
            $table->increments('id');
            $table->string('isim');
            $table->string('dosya');
            $table->unsignedInteger('uzunluk');
            $table->unsignedInteger('tip');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ham_kayitlar');
    }
}
