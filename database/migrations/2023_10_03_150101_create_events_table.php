<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_acara');
            $table->string('nama_acara');
            $table->string('deskripsi');
            $table->string('waktu');
            $table->string('lokasi');
            $table->integer('harga');
            $table->integer('batas pendaftaran');
            $table->string('gambar');
            $table->string('terbuka_untuk');
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
        Schema::dropIfExists('events');
    }
}
