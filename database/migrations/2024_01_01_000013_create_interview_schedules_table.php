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
        Schema::create('interview_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('applications')->cascadeOnDelete();
            $table->enum('interview_type', ['online', 'onsite', 'phone']);
            $table->timestamp('scheduled_at');
            $table->unsignedSmallInteger('duration_minutes')->default(60);
            $table->string('location', 255)->nullable();
            $table->string('meeting_url', 500)->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['scheduled', 'confirmed', 'completed', 'cancelled', 'rescheduled'])->default('scheduled');
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
            
            // Add indexes
            $table->index('application_id', 'idx_application_id');
            $table->index('scheduled_at', 'idx_scheduled_at');
            $table->index('status', 'idx_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interview_schedules');
    }
};