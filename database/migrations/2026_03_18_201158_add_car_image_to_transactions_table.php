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
    Schema::table('transactions', function (Blueprint $table) {
        // Kita tambahin kolom car_image setelah customer_phone
        // nullable() artinya boleh kosong kalau Ayah lupa foto
        $table->string('car_image')->nullable()->after('customer_phone');
    });
}

public function down()
{
    Schema::table('transactions', function (Blueprint $table) {
        // Ini buat jaga-jaga kalau mau ngebatalin (rollback)
        $table->dropColumn('car_image');
    });
}
};
