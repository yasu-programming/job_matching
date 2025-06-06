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
            
            // Application status tracking
            $table->enum('status', [
                'pending', 
                'reviewing', 
                'interview_scheduled', 
                'interview_completed', 
                'accepted', 
                'rejected', 
                'withdrawn'
            ])->default('pending');
            
            // Timeline tracking
            $table->timestamp('applied_at')->useCurrent();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamp('interview_scheduled_at')->nullable();
            $table->timestamp('decision_made_at')->nullable();
            
            // Additional notes
            $table->text('notes')->nullable();
            
            $table->timestamps();
            
            // Unique constraint - one application per job posting per jobseeker
            $table->unique(['job_posting_id', 'jobseeker_id'], 'unique_application');
            
            // Indexes for performance
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