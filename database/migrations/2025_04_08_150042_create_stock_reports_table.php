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
        Schema::create('stock_reports', function (Blueprint $table) {
            $table->id(); // Equivalent to: bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY
            $table->string('item_name');
            $table->string('description', 250)->nullable();
            $table->integer('stock_before')->default(0);
            $table->integer('requested_quantity')->default(0);
            $table->integer('balance')->default(0);
            $table->string('requested_by')->nullable();
            $table->string('approved_by', 250)->nullable();
            $table->timestamp('applied_date')->nullable();
            $table->timestamp('approved_date')->nullable();
            $table->timestamps(); // Adds created_at and updated_at as nullable timestamps
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_reports');
    }
};
