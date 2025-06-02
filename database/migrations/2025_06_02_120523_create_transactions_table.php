<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            $table->string('service_name');
            $table->string('service_detail')->nullable();
            $table->bigInteger('price');
            $table->bigInteger('total_price');
            $table->string('status'); // contoh: Selesai, Dibatalkan, Pending, dll
            $table->text('note')->nullable();
            $table->string('service_image')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
