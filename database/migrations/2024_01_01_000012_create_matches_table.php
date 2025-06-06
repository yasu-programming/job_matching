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
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_posting_id')->constrained('job_postings')->cascadeOnDelete();
            $table->foreignId('jobseeker_id')->constrained('users')->cascadeOnDelete();
            $table->decimal('match_score', 5, 2);
            $table->json('match_factors')->nullable();
            $table->timestamp('created_at')->useCurrent();
            
            // Add unique constraint and indexes
            $table->unique(['job_posting_id', 'jobseeker_id'], 'unique_match');
            $table->index('job_posting_id', 'idx_job_posting_id');
            $table->index('jobseeker_id', 'idx_jobseeker_id');
            $table->index('match_score', 'idx_match_score');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};