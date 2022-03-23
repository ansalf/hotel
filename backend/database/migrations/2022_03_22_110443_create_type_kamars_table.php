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
        Schema::create('type_kamars', function (Blueprint $table) {
            $table->id();
            $table->enum('type_kamar', ['VIP', 'VVIP', 'Suite', 'Double', 'Single'])->default('Single');
            $table->string('fasilitas');
            $table->integer('jumlah_kamar');
            $table->string('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_kamars');
    }
};
