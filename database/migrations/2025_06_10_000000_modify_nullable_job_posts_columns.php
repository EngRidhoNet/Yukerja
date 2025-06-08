<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('job_posts', function (Blueprint $table) {
            $table->decimal('budget', 12, 2)->nullable()->change();
            $table->dateTime('scheduled_date')->nullable()->change();
            $table->dateTime('completion_deadline')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('job_posts', function (Blueprint $table) {
            $table->decimal('budget', 12, 2)->nullable(false)->change();
            $table->dateTime('scheduled_date')->nullable(false)->change();
            $table->dateTime('completion_deadline')->nullable(false)->change();
        });
    }
};
