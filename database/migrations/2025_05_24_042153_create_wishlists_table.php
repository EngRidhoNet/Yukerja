<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('job_post_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['customer_id', 'job_post_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('wishlists');
    }
};