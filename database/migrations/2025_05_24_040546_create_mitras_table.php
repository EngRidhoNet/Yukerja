<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mitras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('business_name');
            $table->text('description')->nullable();
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
            $table->foreignId('service_category_id')->nullable()->constrained('service_categories')->onDelete('cascade');
            $table->string('service_area')->nullable();
            $table->string('profile_photo')->nullable();
            $table->string('cover_photo')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->string('identity_card_number')->nullable();
            $table->string('identity_card_photo')->nullable();
            $table->string('business_license_number')->nullable();
            $table->string('business_license_photo')->nullable();
            $table->float('avg_rating')->default(0);
            $table->integer('completed_jobs')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mitras');
    }
};