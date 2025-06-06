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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Personal information
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['male', 'female', 'other', 'prefer_not_to_say'])->nullable();
            
            // Location information
            $table->string('prefecture', 50)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('nearest_station', 100)->nullable();
            
            // Professional information
            $table->text('biography')->nullable();
            $table->tinyInteger('experience_years')->unsigned()->default(0);
            $table->enum('education_level', [
                'high_school', 
                'vocational', 
                'associate', 
                'bachelor', 
                'master', 
                'doctorate'
            ])->nullable();
            
            // Salary expectations
            $table->integer('desired_salary_min')->unsigned()->nullable();
            $table->integer('desired_salary_max')->unsigned()->nullable();
            
            // Employment preferences
            $table->enum('desired_employment_type', [
                'full_time', 
                'part_time', 
                'contract', 
                'freelance'
            ])->nullable();
            $table->date('available_start_date')->nullable();
            
            // Skills and qualifications (JSON fields)
            $table->json('skills')->nullable();
            $table->json('certifications')->nullable();
            $table->json('languages')->nullable();
            
            // Work location preference
            $table->enum('work_location_preference', ['office', 'remote', 'hybrid'])->nullable();
            
            $table->timestamps();
            
            // Indexes for better performance
            $table->index('user_id', 'idx_jobseeker_profiles_user_id');
            $table->index('prefecture', 'idx_jobseeker_profiles_prefecture');
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