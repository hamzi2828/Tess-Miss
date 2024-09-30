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
        
        Schema::create('user_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key referencing users table
            $table->boolean('add_kyc')->default(false);
            $table->boolean('view_kyc')->default(false);
            $table->boolean('change_kyc')->default(false);
            $table->boolean('approve_kyc')->default(false);
        
            $table->boolean('add_documents')->default(false);
            $table->boolean('view_documents')->default(false);
            $table->boolean('change_documents')->default(false);
            $table->boolean('approve_documents')->default(false);
        
            $table->boolean('add_sales')->default(false);
            $table->boolean('view_sales')->default(false);
            $table->boolean('change_sales')->default(false);
            $table->boolean('approve_sales')->default(false);
        
            $table->boolean('add_services')->default(false);
            $table->boolean('view_services')->default(false);
            $table->boolean('change_services')->default(false);
            $table->boolean('approve_services')->default(false);
        
            $table->boolean('add_user')->default(false);
            $table->boolean('view_users')->default(false);
            $table->boolean('change_user')->default(false);
        
            $table->timestamps();
        
            // Foreign key relation
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_permissions');
    }
};
