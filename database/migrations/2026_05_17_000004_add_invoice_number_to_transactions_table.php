<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('invoice_number')->nullable()->unique()->after('id');
            $table->unsignedBigInteger('booking_id')->nullable()->after('invoice_number');
            $table->string('payment_method')->default('tunai')->after('total_price');
            $table->integer('amount_paid')->default(0)->after('payment_method');
            $table->integer('change_amount')->default(0)->after('amount_paid');
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['booking_id']);
            $table->dropColumn(['invoice_number', 'booking_id', 'payment_method', 'amount_paid', 'change_amount']);
        });
    }
};
