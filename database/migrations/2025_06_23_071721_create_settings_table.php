<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key', 100)->unique();  // Misalnya, 'commission_rate'
            $table->decimal('value', 5, 2);  // Persentase komisi, misal 20.00
            $table->unsignedBigInteger('updated_by')->nullable();  // Admin ID yang terakhir mengubah
            $table->timestamps();

            // FK untuk admin
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
