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
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('jobseeker_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('job_posting_id')->nullable()->constrained('job_postings')->nullOnDelete();
            $table->string('subject', 255);
            $table->text('message');
            $table->enum('status', ['sent', 'read', 'replied', 'ignored', 'accepted', 'declined'])->default('sent');
            $table->timestamp('sent_at')->useCurrent();
            $table->timestamp('read_at')->nullable();
            $table->timestamp('replied_at')->nullable();
            $table->timestamps();
            
            // Add indexes
            $table->index('company_id', 'idx_company_id');
            $table->index('jobseeker_id', 'idx_jobseeker_id');
            $table->index('status', 'idx_status');
            $table->index('sent_at', 'idx_sent_at');
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