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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_posting_id')->constrained('job_postings')->cascadeOnDelete();
            $table->foreignId('jobseeker_id')->constrained('users')->cascadeOnDelete();
            $table->text('cover_letter')->nullable();
            $table->string('resume_file_path', 500)->nullable();
            $table->enum('status', ['pending', 'reviewing', 'interview_scheduled', 'interview_completed', 'accepted', 'rejected', 'withdrawn'])->default('pending');
            $table->timestamp('applied_at')->useCurrent();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamp('interview_scheduled_at')->nullable();
            $table->timestamp('decision_made_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            
            // Add unique constraint and indexes
            $table->unique(['job_posting_id', 'jobseeker_id'], 'unique_application');
            $table->index('job_posting_id', 'idx_job_posting_id');
            $table->index('jobseeker_id', 'idx_jobseeker_id');
            $table->index('status', 'idx_status');
            $table->index('applied_at', 'idx_applied_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};