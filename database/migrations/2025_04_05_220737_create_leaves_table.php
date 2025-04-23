<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->date('applied_date')->default(DB::raw('CURRENT_DATE'));
            $table->text('reason');
            $table->string('leave_type')->default('Annual leave');
            $table->decimal('leave_balance_before', 10, 2)->nullable();
            $table->decimal('leave_balance_after', 10, 2)->nullable();
            $table->string('status')->default('Pending');
            $table->unsignedBigInteger('approved_by')->nullable(); // No foreign key constraint
            $table->dateTime('approval_date')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};