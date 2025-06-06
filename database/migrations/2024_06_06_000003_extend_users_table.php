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
        Schema::table('users', function (Blueprint $table) {
            // Rename 'name' to individual fields
            $table->string('first_name', 100)->nullable()->after('password');
            $table->string('last_name', 100)->nullable()->after('first_name');
            
            // Add new required fields
            $table->enum('user_type', ['jobseeker', 'company', 'admin'])->after('password');
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active')->after('user_type');
            
            // Add optional fields
            $table->string('phone', 20)->nullable()->after('last_name');
            $table->string('avatar_url', 500)->nullable()->after('phone');
            
            // Add soft deletes
            $table->timestamp('deleted_at')->nullable()->after('updated_at');
            
            // Add indexes for performance
            $table->index('user_type', 'idx_user_type');
            $table->index('status', 'idx_status');
            $table->index('email', 'idx_email');
        });
        
        // Drop the old 'name' column
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Add back the 'name' column
            $table->string('name')->after('id');
            
            // Drop new columns
            $table->dropColumn([
                'user_type',
                'status', 
                'first_name',
                'last_name',
                'phone',
                'avatar_url',
                'deleted_at'
            ]);
            
            // Drop indexes
            $table->dropIndex('idx_user_type');
            $table->dropIndex('idx_status');
            $table->dropIndex('idx_email');
        });
    }
};