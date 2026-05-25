<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->index('created_at');
            $table->index('customer_phone');
            $table->index('invoice_number');
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->index('booking_date');
            $table->index('status');
            $table->index('phone');
        });

        Schema::table('items', function (Blueprint $table) {
            $table->index('category');
            $table->index('name');
        });

        Schema::table('expenses', function (Blueprint $table) {
            $table->index('date');
            $table->index('category');
        });
    }

    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
            $table->dropIndex(['customer_phone']);
            $table->dropIndex(['invoice_number']);
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->dropIndex(['booking_date']);
            $table->dropIndex(['status']);
            $table->dropIndex(['phone']);
        });

        Schema::table('items', function (Blueprint $table) {
            $table->dropIndex(['category']);
            $table->dropIndex(['name']);
        });

        Schema::table('expenses', function (Blueprint $table) {
            $table->dropIndex(['date']);
            $table->dropIndex(['category']);
        });
    }
};
