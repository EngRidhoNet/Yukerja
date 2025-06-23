<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_post_id')->constrained()->onDelete('cascade');
            $table->foreignId('mitra_id')->constrained()->onDelete('cascade');
            $table->string('status')->default('pending');
            $table->text('message')->nullable();
            $table->decimal('bid_amount', 12, 2);
            $table->dateTime('estimated_completion_time');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_applications');
    }
};