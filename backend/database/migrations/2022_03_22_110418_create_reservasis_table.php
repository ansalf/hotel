<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            $table->integer('id_reservasi');
            $table->timestamp('tanggal_reservasi');
            $table->time('tanggal_checkIn');
            $table->time('tanggal_checkOut');
            $table->integer('id_tamu');
            $table->string('nama_tamu');
            $table->string('email');
            $table->integer('no_hp');
            $table->enum('type_kamar', ['VIP', 'VVIP', 'Suite', 'Double', 'Single'])->default('Single');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservasis');
    }
};
