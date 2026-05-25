<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->string('plate_number')->unique();
            $table->string('brand')->nullable(); // e.g. Toyota
            $table->string('model')->nullable(); // e.g. Avanza
            $table->string('year')->nullable();
            $table->string('vin')->nullable(); // No Rangka
            $table->string('engine_number')->nullable(); // No Mesin
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
};
