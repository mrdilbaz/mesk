<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKasidelerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kasideler', function (Blueprint $table) {
            $table->increments('id');
            $table->string('isim');
            $table->unsignedInteger('gufte_zat');
            $table->unsignedInteger('beste_zat');
            $table->unsignedInteger('gufte');
            $table->unsignedInteger('makam');
            $table->unsignedInteger('uzunluk');
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
        Schema::dropIfExists('kasideler');
    }
}
