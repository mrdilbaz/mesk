<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZatlarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zatlar', function (Blueprint $table) {
            $table->increments('id');
            $table->string('isim');
            $table->text('bilgi');
            $table->unsignedInteger('tarikat');
            $table->unsignedInteger('selef');
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
        Schema::dropIfExists('zatlar');
    }
}
