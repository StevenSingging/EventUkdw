<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('acara_id');
            $table->unsignedBigInteger('pendaftaran_id');
            $table->date('tanggal_pembayaran')->nullable();
            $table->integer('jumlah_pembayaran');
            $table->string('bukti_pembayaran')->nullable();
            $table->enum('status_pembayaran', ['0', '1'])->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('acara_id')->references('id')->on('events');
            $table->foreign('pendaftaran_id')->references('id')->on('pendaftaran_acaras');
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
        Schema::dropIfExists('pembayarans');
    }
}
