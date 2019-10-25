<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHasilPemilihan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_pemilihan',function(Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('kelas');
            $table->integer('no_kandidat');
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
        Schema::drop('hasil_pemilihan');
    }
}
