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
        Schema::create('jobseeker_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['male', 'female', 'other', 'prefer_not_to_say'])->nullable();
            $table->string('prefecture', 50)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('nearest_station', 100)->nullable();
            $table->text('biography')->nullable();
            $table->unsignedTinyInteger('experience_years')->default(0);
            $table->enum('education_level', ['high_school', 'vocational', 'associate', 'bachelor', 'master', 'doctorate'])->nullable();
            $table->unsignedInteger('desired_salary_min')->nullable();
            $table->unsignedInteger('desired_salary_max')->nullable();
            $table->enum('desired_employment_type', ['full_time', 'part_time', 'contract', 'freelance'])->nullable();
            $table->date('available_start_date')->nullable();
            $table->json('skills')->nullable();
            $table->json('certifications')->nullable();
            $table->json('languages')->nullable();
            $table->enum('work_location_preference', ['office', 'remote', 'hybrid'])->nullable();
            $table->timestamps();
            
            // Add indexes
            $table->index('user_id', 'idx_user_id');
            $table->index('prefecture', 'idx_prefecture');
            $table->index('experience_years', 'idx_experience_years');
            $table->index('desired_salary_min', 'idx_desired_salary_min');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobseeker_profiles');
    }
};