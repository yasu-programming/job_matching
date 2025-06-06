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
            // Add user type (jobseeker, company, admin)
            $table->enum('user_type', ['jobseeker', 'company', 'admin'])->after('password');
            
            // Add status (active, inactive, suspended)
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active')->after('user_type');
            
            // Split name into first_name and last_name, remove original name column
            $table->string('first_name', 100)->nullable()->after('status');
            $table->string('last_name', 100)->nullable()->after('first_name');
            
            // Add additional user fields
            $table->string('phone', 20)->nullable()->after('last_name');
            $table->string('avatar_url', 500)->nullable()->after('phone');
            
            // Add soft deletes
            $table->timestamp('deleted_at')->nullable()->after('updated_at');
            
            // Add indexes for better performance
            $table->index('user_type', 'idx_user_type');
            $table->index('status', 'idx_users_status');
        });
        
        // Remove the original name column after adding first_name and last_name
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
            // Add back the name column
            $table->string('name')->after('id');
        });
        
        Schema::table('users', function (Blueprint $table) {
            // Drop indexes
            $table->dropIndex('idx_user_type');
            $table->dropIndex('idx_users_status');
            
            // Drop added columns
            $table->dropColumn([
                'user_type',
                'status', 
                'first_name',
                'last_name',
                'phone',
                'avatar_url',
                'deleted_at'
            ]);
        });
    }
};