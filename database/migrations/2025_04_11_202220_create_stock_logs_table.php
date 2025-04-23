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
        Schema::create('stock_logs', function (Blueprint $table) {
            $table->id(); // bigint unsigned auto-increment primary key
            $table->string('item_name');
            $table->decimal('unit_price', 8, 2);
            $table->string('supplier')->nullable();
            $table->integer('stock_quantity')->default(0);
            $table->integer('balance')->default(0);
            $table->string('requested_by')->nullable();
            $table->string('approved_by')->nullable();
            $table->timestamp('approved_date')->nullable();
            $table->string('status')->default('Available');
            $table->timestamps(); // creates `created_at` and `updated_at`
            $table->string('description', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_logs');
    }
};
