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
            $table->foreignId('application_id')->constrained('applications')->onDelete('cascade');
            
            // Interview details
            $table->enum('interview_type', ['online', 'onsite', 'phone']);
            $table->timestamp('scheduled_at')->index('idx_scheduled_at');
            $table->smallInteger('duration_minutes')->unsigned()->default(60);
            
            // Location and meeting details
            $table->string('location', 255)->nullable(); // Physical location for onsite interviews
            $table->string('meeting_url', 500)->nullable(); // Meeting URL for online interviews
            $table->text('notes')->nullable();
            
            // Interview status
            $table->enum('status', ['scheduled', 'confirmed', 'completed', 'cancelled', 'rescheduled'])->default('scheduled')->index('idx_interview_schedules_status');
            
            // Who created this schedule
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            
            $table->timestamps();
            
            // Indexes for better performance
            $table->index('application_id', 'idx_interview_schedules_application_id');
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