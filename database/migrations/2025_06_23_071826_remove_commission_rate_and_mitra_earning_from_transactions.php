<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveCommissionRateAndMitraEarningFromTransactions extends Migration
{
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['admin_fee', 'mitra_earning']);
        });
    }

    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->decimal('admin_fee', 5, 2)->default(20.00);
            $table->decimal('mitra_earning', 14, 2);
        });
    }
}
