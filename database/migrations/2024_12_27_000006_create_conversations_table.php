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
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->foreignId('jobseeker_id')->constrained('users')->onDelete('cascade');
            
            // Optional references to application or scout
            $table->foreignId('application_id')->nullable()->constrained('applications')->onDelete('set null');
            $table->foreignId('scout_id')->nullable(); // Will be linked when scouts table is created
            
            // Conversation status
            $table->enum('status', ['active', 'archived', 'blocked'])->default('active');
            
            // Track last message time for sorting
            $table->timestamp('last_message_at')->nullable()->index('idx_last_message_at');
            
            $table->timestamps();
            
            // Ensure unique conversation between company and jobseeker
            $table->unique(['company_id', 'jobseeker_id'], 'unique_conversation');
            
            // Indexes for better performance
            $table->index('company_id', 'idx_conversations_company_id');
            $table->index('jobseeker_id', 'idx_conversations_jobseeker_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};