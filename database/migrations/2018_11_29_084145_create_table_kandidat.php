<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableKandidat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kandidats',function(Blueprint $table) {
            $table->increments('id');
            $table->integer('no_kandidat');
            $table->string('nama');
            $table->string('foto');
            $table->string('kelas');
            $table->text('visi');
            $table->text('misi');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('kandidat');
    }
}
