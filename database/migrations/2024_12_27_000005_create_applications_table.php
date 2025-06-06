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
            $table->foreignId('job_posting_id')->constrained('job_postings')->onDelete('cascade');
            $table->foreignId('jobseeker_id')->constrained('users')->onDelete('cascade');
            
            // Application content
            $table->text('cover_letter')->nullable();
            $table->string('resume_file_path', 500)->nullable();
            
            // Application status and timeline
            $table->enum('status', [
                'pending', 
                'reviewing', 
                'interview_scheduled', 
                'interview_completed', 
                'accepted', 
                'rejected', 
                'withdrawn'
            ])->default('pending')->index('idx_applications_status');
            
            // Important timestamps
            $table->timestamp('applied_at')->useCurrent()->index('idx_applied_at');
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamp('interview_scheduled_at')->nullable();
            $table->timestamp('decision_made_at')->nullable();
            
            // Additional notes
            $table->text('notes')->nullable();
            
            $table->timestamps();
            
            // Unique constraint to prevent duplicate applications
            $table->unique(['job_posting_id', 'jobseeker_id'], 'unique_application');
            
            // Indexes for better performance
            $table->index('job_posting_id', 'idx_applications_job_posting_id');
            $table->index('jobseeker_id', 'idx_applications_jobseeker_id');
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