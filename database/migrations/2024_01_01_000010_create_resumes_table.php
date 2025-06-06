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
            $table->foreignId('jobseeker_id')->constrained('users')->cascadeOnDelete();
            $table->string('file_name', 255);
            $table->string('original_name', 255);
            $table->string('file_path', 500);
            $table->unsignedInteger('file_size');
            $table->string('mime_type', 100);
            $table->unsignedTinyInteger('version')->default(1);
            $table->boolean('is_primary')->default(false);
            $table->enum('status', ['uploading', 'scanning', 'approved', 'rejected'])->default('uploading');
            $table->timestamp('uploaded_at')->useCurrent();
            $table->timestamps();
            
            // Add indexes
            $table->index('jobseeker_id', 'idx_jobseeker_id');
            $table->index('is_primary', 'idx_is_primary');
            $table->index('status', 'idx_status');
            $table->index('uploaded_at', 'idx_uploaded_at');
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