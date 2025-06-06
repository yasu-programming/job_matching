<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Notification content
            $table->string('type', 100)->index('idx_type'); // e.g., 'new_message', 'application_status', 'match_found'
            $table->string('title', 255);
            $table->text('message');
            
            // Additional data (JSON format for flexibility)
            $table->json('data')->nullable(); // Can store related IDs, links, etc.
            
            // Read status
            $table->boolean('is_read')->default(false)->index('idx_is_read');
            $table->timestamp('read_at')->nullable();
            
            $table->timestamp('created_at')->useCurrent()->index('idx_created_at');
            
            // Index for user notifications
            $table->index('user_id', 'idx_user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};