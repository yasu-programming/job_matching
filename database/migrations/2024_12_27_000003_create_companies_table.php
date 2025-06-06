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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Company basic information
            $table->string('company_name', 255)->index('idx_company_name');
            $table->string('company_name_kana', 255)->nullable();
            $table->string('industry', 100)->nullable()->index('idx_industry');
            
            // Company size and details
            $table->enum('company_size', ['startup', 'small', 'medium', 'large', 'enterprise'])->nullable();
            $table->year('established_year')->nullable();
            $table->integer('capital')->unsigned()->nullable();
            $table->integer('employee_count')->unsigned()->nullable();
            
            // Company online presence
            $table->string('website_url', 500)->nullable();
            $table->text('description')->nullable();
            
            // Company location
            $table->string('prefecture', 50)->nullable()->index('idx_prefecture');
            $table->string('city', 100)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->string('phone', 20)->nullable();
            
            // Company branding
            $table->string('logo_url', 500)->nullable();
            
            $table->timestamps();
            
            // Additional indexes
            $table->index('user_id', 'idx_user_id');
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