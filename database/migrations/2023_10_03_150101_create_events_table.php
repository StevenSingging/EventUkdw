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
            $table->string('warna');
            $table->text('deskripsi');
            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_selesai');
            $table->string('lokasi');
            $table->integer('harga_dosen')->nullable();
            $table->integer('harga_mhs')->nullable();
            $table->integer('harga_umum')->nullable();
            $table->integer('harga_staff')->nullable();
            $table->dateTime('batas_pendaftaran');
            $table->integer('kuota')->nullable();
            $table->string('gambar');
            $table->string('terbuka_untuk');
            $table->unsignedBigInteger('penganggung_jawab');
            $table->enum('status', ['0', '1'])->nullable();
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
