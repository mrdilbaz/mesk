<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaksimlerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taksimler', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('makam');
            $table->unsignedInteger('uzunluk');
            $table->unsignedInteger('icra_zat');
            $table->unsignedInteger('ham_kayit');
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
        Schema::dropIfExists('taksimler');
    }
}
