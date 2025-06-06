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
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jobseeker_id')->constrained('users')->onDelete('cascade');
            
            // File information
            $table->string('file_name', 255); // Internal file name
            $table->string('original_name', 255); // User's original file name
            $table->string('file_path', 500);
            $table->integer('file_size')->unsigned();
            $table->string('mime_type', 100);
            
            // Version and status
            $table->tinyInteger('version')->unsigned()->default(1);
            $table->boolean('is_primary')->default(false)->index('idx_is_primary');
            $table->enum('status', ['uploading', 'scanning', 'approved', 'rejected'])->default('uploading')->index('idx_resumes_status');
            
            // Timestamps
            $table->timestamp('uploaded_at')->useCurrent()->index('idx_uploaded_at');
            $table->timestamps();
            
            // Index for jobseeker resumes
            $table->index('jobseeker_id', 'idx_resumes_jobseeker_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resumes');
    }
};