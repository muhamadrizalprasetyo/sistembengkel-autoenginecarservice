<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('transaction_details', function (Blueprint $table) {
        $table->id();
        $table->foreignId('transaction_id')->constrained()->onDelete('cascade');
        
        // Kuncinya di sini: item_id harus nullable() biar Jasa Manual bisa masuk
        $table->unsignedBigInteger('item_id')->nullable(); 
        
        $table->string('item_name'); // Simpan nama barang/jasa di sini
        $table->integer('qty');
        $table->integer('subtotal');
        $table->timestamps();
    });
} 

    public function down()
    {
        Schema::dropIfExists('transaction_details');
    }
};