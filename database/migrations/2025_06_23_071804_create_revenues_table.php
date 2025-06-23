<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevenuesTable extends Migration
{
    public function up()
    {
        Schema::create('revenues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_id');  // Referensi ke transaksi
            $table->decimal('amount', 14, 2);  // Total biaya transaksi
            $table->decimal('commission_rate', 5, 2);  // Komisi berdasarkan rate (misal 20.00)
            $table->decimal('platform_share', 14, 2);  // Bagian platform: amount * (commission_rate/100)
            $table->decimal('mitra_share', 14, 2);  // Bagian mitra: amount - platform_share
            $table->timestamps();

            // FK untuk transaksi
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('revenues');
    }
}
