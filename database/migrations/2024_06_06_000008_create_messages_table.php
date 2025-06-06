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
        // First create conversations table
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->foreignId('jobseeker_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('application_id')->nullable()->constrained('applications')->onDelete('set null');
            $table->enum('status', ['active', 'archived', 'blocked'])->default('active');
            $table->timestamp('last_message_at')->nullable();
            $table->timestamps();
            
            // Unique conversation between company and jobseeker
            $table->unique(['company_id', 'jobseeker_id'], 'unique_conversation');
            
            // Indexes for performance
            $table->index('company_id', 'idx_company_id');
            $table->index('jobseeker_id', 'idx_jobseeker_id');
            $table->index('last_message_at', 'idx_last_message_at');
        });
        
        // Then create messages table
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')->constrained('conversations')->onDelete('cascade');
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            
            // Message content
            $table->enum('message_type', ['text', 'file', 'system'])->default('text');
            $table->text('content')->nullable();
            
            // File attachment details
            $table->string('file_path', 500)->nullable();
            $table->string('file_name', 255)->nullable();
            $table->unsignedInteger('file_size')->nullable();
            
            // Read status
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            
            $table->timestamp('created_at')->useCurrent();
            
            // Indexes for performance
            $table->index('conversation_id', 'idx_conversation_id');
            $table->index('sender_id', 'idx_sender_id');
            $table->index('created_at', 'idx_created_at');
            $table->index('is_read', 'idx_is_read');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
        Schema::dropIfExists('conversations');
    }
};