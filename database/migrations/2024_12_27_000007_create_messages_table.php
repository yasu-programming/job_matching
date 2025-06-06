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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')->constrained('conversations')->onDelete('cascade');
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            
            // Message content and type
            $table->enum('message_type', ['text', 'file', 'system'])->default('text');
            $table->text('content')->nullable(); // For text messages
            
            // File attachment information
            $table->string('file_path', 500)->nullable();
            $table->string('file_name', 255)->nullable();
            $table->integer('file_size')->unsigned()->nullable();
            
            // Read status
            $table->boolean('is_read')->default(false)->index('idx_is_read');
            $table->timestamp('read_at')->nullable();
            
            $table->timestamp('created_at')->useCurrent()->index('idx_created_at');
            
            // Indexes for better performance
            $table->index('conversation_id', 'idx_conversation_id');
            $table->index('sender_id', 'idx_sender_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};