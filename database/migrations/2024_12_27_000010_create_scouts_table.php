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
        Schema::create('scouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->foreignId('jobseeker_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('job_posting_id')->nullable()->constrained('job_postings')->onDelete('set null');
            
            // Scout message content
            $table->string('subject', 255);
            $table->text('message');
            
            // Scout status
            $table->enum('status', ['sent', 'read', 'replied', 'ignored', 'accepted', 'declined'])->default('sent')->index('idx_scouts_status');
            
            // Timeline
            $table->timestamp('sent_at')->useCurrent()->index('idx_sent_at');
            $table->timestamp('read_at')->nullable();
            $table->timestamp('replied_at')->nullable();
            
            $table->timestamps();
            
            // Indexes for better performance
            $table->index('company_id', 'idx_scouts_company_id');
            $table->index('jobseeker_id', 'idx_scouts_jobseeker_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scouts');
    }
};