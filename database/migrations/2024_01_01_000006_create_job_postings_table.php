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
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->string('title', 255);
            $table->text('description');
            $table->text('requirements')->nullable();
            $table->text('benefits')->nullable();
            $table->enum('employment_type', ['full_time', 'part_time', 'contract', 'freelance']);
            $table->string('work_location', 255)->nullable();
            $table->enum('work_location_type', ['office', 'remote', 'hybrid'])->default('office');
            $table->unsignedInteger('salary_min')->nullable();
            $table->unsignedInteger('salary_max')->nullable();
            $table->enum('salary_type', ['monthly', 'annual', 'hourly'])->default('monthly');
            $table->unsignedTinyInteger('experience_required')->default(0);
            $table->json('required_skills')->nullable();
            $table->json('preferred_skills')->nullable();
            $table->enum('education_requirement', ['none', 'high_school', 'vocational', 'associate', 'bachelor', 'master', 'doctorate'])->default('none');
            $table->date('application_deadline')->nullable();
            $table->enum('status', ['draft', 'published', 'closed', 'archived'])->default('draft');
            $table->unsignedInteger('view_count')->default(0);
            $table->unsignedInteger('application_count')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            
            // Add indexes
            $table->index('company_id', 'idx_company_id');
            $table->index('status', 'idx_status');
            $table->index('employment_type', 'idx_employment_type');
            $table->index('salary_min', 'idx_salary_min');
            $table->index('experience_required', 'idx_experience_required');
            $table->index('published_at', 'idx_published_at');
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