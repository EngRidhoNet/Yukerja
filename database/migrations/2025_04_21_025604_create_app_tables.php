<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Users table
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role')->default('customer'); // customer, mitra, admin
            $table->string('profile_photo')->nullable();
            $table->string('device_token')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });

        // Service Categories table
        Schema::create('service_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Customers table
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
            $table->integer('loyalty_points')->default(0);
            $table->string('identity_card_number')->nullable();
            $table->string('identity_card_photo')->nullable();
            $table->timestamps();
        });

        // Mitras table
        Schema::create('mitras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('business_name');
            $table->text('description')->nullable();
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
            $table->string('service_category')->nullable();
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

        // Mitra Skills table
        Schema::create('mitra_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mitra_id')->constrained()->onDelete('cascade');
            $table->string('skill_name');
            $table->integer('experience_years')->nullable();
            $table->string('certification')->nullable();
            $table->timestamps();
        });

        // Mitra Portfolio table
        Schema::create('mitra_portfolio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mitra_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->date('completion_date')->nullable();
            $table->timestamps();
        });

        // Job Posts table
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_category_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->string('category')->nullable();
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
            $table->text('address')->nullable();
            $table->decimal('budget', 12, 2);
            $table->dateTime('scheduled_date');
            $table->dateTime('completion_deadline');
            $table->string('status')->default('open');
            $table->string('cancellation_reason')->nullable();
            $table->timestamps();
        });

        // Job Attachments table
        Schema::create('job_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_post_id')->constrained()->onDelete('cascade');
            $table->string('file_name');
            $table->string('file_url');
            $table->string('file_type')->nullable();
            $table->timestamps();
        });

        // Job Applications table
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

        // Transactions table
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_post_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('mitra_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 12, 2);
            $table->decimal('admin_fee', 12, 2);
            $table->decimal('mitra_earning', 12, 2);
            $table->string('payment_status');
            $table->string('payment_method')->nullable();
            $table->string('invoice_number');
            $table->dateTime('payment_date')->nullable();
            $table->string('transaction_reference')->nullable();
            $table->timestamps();
        });

        // Transaction Logs table
        Schema::create('transaction_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained()->onDelete('cascade');
            $table->string('status');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Withdrawals table
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mitra_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 12, 2);
            $table->string('status')->default('pending');
            $table->string('bank_name');
            $table->string('account_number');
            $table->string('account_name');
            $table->dateTime('processed_date')->nullable();
            $table->timestamps();
        });

        // Reviews table
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('mitra_id')->constrained()->onDelete('cascade');
            $table->foreignId('job_post_id')->constrained()->onDelete('cascade');
            $table->integer('rating');
            $table->text('comment')->nullable();
            $table->text('mitra_response')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });

        // Chat Rooms table
        Schema::create('chat_rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_post_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('mitra_id')->constrained()->onDelete('cascade');
            $table->timestamp('last_message_at')->nullable();
            $table->timestamps();
        });

        // Chats table
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_post_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('receiver_id');
            $table->text('message');
            $table->string('type')->default('text');
            $table->string('file_url')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamps();
            
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Notifications table
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('type');
            $table->string('title');
            $table->text('content');
            $table->string('redirect_url')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });

        // Subscription Plans table
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 12, 2);
            $table->integer('duration_days');
            $table->integer('featured_days')->default(0);
            $table->integer('max_bids')->nullable();
            $table->boolean('priority_listing')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Subscriptions table
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mitra_id')->constrained()->onDelete('cascade');
            $table->foreignId('subscription_plan_id')->constrained()->onDelete('cascade');
            $table->string('plan_name');
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('is_active')->default(true);
            $table->decimal('amount_paid', 12, 2);
            $table->string('payment_method');
            $table->timestamps();
        });

        // Favorites table
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('mitra_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            // Create a unique constraint to prevent duplicates
            $table->unique(['customer_id', 'mitra_id']);
        });

        // Wishlists table
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('job_post_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            // Create a unique constraint to prevent duplicates
            $table->unique(['customer_id', 'job_post_id']);
        });

        // Reports table
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reporter_id');
            $table->unsignedBigInteger('reported_id');
            $table->string('report_type');
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->string('reason');
            $table->text('description')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
            
            $table->foreign('reporter_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reported_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Admin Actions table
        Schema::create('admin_actions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('target_id');
            $table->string('target_type');
            $table->string('action_type');
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Promotions table
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('discount_amount', 12, 2)->nullable();
            $table->float('discount_percentage')->nullable();
            $table->string('promo_code')->unique();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('usage_limit')->nullable();
            $table->integer('used_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // User Promotions table
        Schema::create('user_promotions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('promotion_id')->constrained()->onDelete('cascade');
            $table->dateTime('used_at');
            $table->timestamps();
            
            // Create a unique constraint to prevent duplicates
            $table->unique(['user_id', 'promotion_id']);
        });

        // Help Center table
        Schema::create('help_center', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('question');
            $table->text('answer');
            $table->integer('view_count')->default(0);
            $table->boolean('is_popular')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop tables in reverse order to avoid foreign key constraints
        Schema::dropIfExists('help_center');
        Schema::dropIfExists('user_promotions');
        Schema::dropIfExists('promotions');
        Schema::dropIfExists('admin_actions');
        Schema::dropIfExists('reports');
        Schema::dropIfExists('wishlists');
        Schema::dropIfExists('favorites');
        Schema::dropIfExists('subscriptions');
        Schema::dropIfExists('subscription_plans');
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('chats');
        Schema::dropIfExists('chat_rooms');
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('withdrawals');
        Schema::dropIfExists('transaction_logs');
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('job_applications');
        Schema::dropIfExists('job_attachments');
        Schema::dropIfExists('job_posts');
        Schema::dropIfExists('mitra_portfolio');
        Schema::dropIfExists('mitra_skills');
        Schema::dropIfExists('mitras');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('service_categories');
        Schema::dropIfExists('users');
    }
};
