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
        if (!Schema::hasTable('requests')) {
            Schema::create('requests', function (Blueprint $table) {
                $table->id();
                $table->string('item_name');
                $table->integer('quantity');
                $table->date('request_date');
                $table->string('status')->default('Pending');
                $table->string('requested_by')->nullable(); // Assuming you want to track who made the request
                $table->string('approved_by')->nullable(); // Assuming you want to track who approved the request
                $table->string('rejected_by')->nullable(); // Assuming you want to track who rejected the request
                $table->text('comments')->nullable(); // Assuming you want to add comments for the request
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
