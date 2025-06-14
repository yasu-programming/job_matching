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
            // Drop the existing name column and add first_name, last_name
            $table->dropColumn('name');
            $table->enum('user_type', ['jobseeker', 'company', 'admin'])->after('password');
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active')->after('user_type');
            $table->string('first_name', 100)->nullable()->after('status');
            $table->string('last_name', 100)->nullable()->after('first_name');
            $table->string('phone', 20)->nullable()->after('last_name');
            $table->string('avatar_url', 500)->nullable()->after('phone');
            $table->softDeletes()->after('updated_at');
            
            // Add indexes
            $table->index('user_type', 'idx_user_type');
            $table->index('status', 'idx_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop added columns and indexes
            $table->dropIndex('idx_user_type');
            $table->dropIndex('idx_status');
            $table->dropSoftDeletes();
            $table->dropColumn([
                'user_type',
                'status', 
                'first_name',
                'last_name',
                'phone',
                'avatar_url'
            ]);
            
            // Re-add the name column
            $table->string('name')->after('id');
        });
    }
};