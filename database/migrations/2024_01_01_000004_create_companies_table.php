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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('company_name', 255);
            $table->string('company_name_kana', 255)->nullable();
            $table->string('industry', 100)->nullable();
            $table->enum('company_size', ['1-10', '11-50', '51-100', '101-500', '501-1000', '1001+'])->nullable();
            $table->year('established_year')->nullable();
            $table->unsignedInteger('capital')->nullable();
            $table->unsignedInteger('employee_count')->nullable();
            $table->string('website_url', 500)->nullable();
            $table->text('description')->nullable();
            $table->string('prefecture', 50)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('logo_url', 500)->nullable();
            $table->timestamps();
            
            // Add indexes (user_id already has foreign key index)
            $table->index('company_name', 'idx_companies_company_name');
            $table->index('industry', 'idx_companies_industry');
            $table->index('prefecture', 'idx_companies_prefecture');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};