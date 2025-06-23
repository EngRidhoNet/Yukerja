<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mitra_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mitra_id')->constrained()->onDelete('cascade');
            $table->string('skill_name');
            $table->integer('experience_years')->nullable();
            $table->string('certification')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mitra_skills');
    }
};