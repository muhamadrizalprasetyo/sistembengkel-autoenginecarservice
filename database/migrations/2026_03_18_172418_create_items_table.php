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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama oli, busi, atau nama jasa
            $table->string('category'); // Kategori: 'sparepart' atau 'service'
            $table->integer('price'); // Harga jual atau harga jasa
            $table->integer('stock')->nullable(); // Stok barang (boleh kosong buat jasa)
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
        Schema::dropIfExists('items');
    }
};