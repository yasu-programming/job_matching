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
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            
            // Job basic information
            $table->string('title', 255);
            $table->text('description');
            $table->text('requirements')->nullable();
            $table->text('benefits')->nullable();
            
            // Employment details
            $table->enum('employment_type', ['full_time', 'part_time', 'contract', 'freelance'])->index('idx_employment_type');
            $table->string('work_location', 255)->nullable();
            $table->enum('work_location_type', ['office', 'remote', 'hybrid'])->default('office');
            
            // Salary information
            $table->integer('salary_min')->unsigned()->nullable()->index('idx_salary_min');
            $table->integer('salary_max')->unsigned()->nullable();
            $table->enum('salary_type', ['monthly', 'annual', 'hourly'])->default('monthly');
            
            // Requirements
            $table->tinyInteger('experience_required')->unsigned()->default(0)->index('idx_experience_required');
            $table->json('required_skills')->nullable();
            $table->json('preferred_skills')->nullable();
            $table->enum('education_requirement', [
                'none', 
                'high_school', 
                'vocational', 
                'associate', 
                'bachelor', 
                'master', 
                'doctorate'
            ])->default('none');
            
            // Application and status
            $table->date('application_deadline')->nullable();
            $table->enum('status', ['draft', 'published', 'closed', 'archived'])->default('draft')->index('idx_status');
            
            // Analytics
            $table->integer('view_count')->unsigned()->default(0);
            $table->integer('application_count')->unsigned()->default(0);
            
            $table->timestamps();
            $table->timestamp('published_at')->nullable()->index('idx_published_at');
            
            // Additional indexes
            $table->index('company_id', 'idx_company_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_postings');
    }
};