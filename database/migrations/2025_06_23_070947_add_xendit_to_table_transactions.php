<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('xendit_invoice_id')->nullable()->after('invoice_number');
            $table->string('xendit_external_id')->nullable()->after('xendit_invoice_id');
            $table->text('payment_url')->nullable()->after('xendit_external_id');
        });
    }

    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['xendit_invoice_id', 'xendit_external_id', 'payment_url']);
        });
    }
};