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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->default('male');
            $table->string('national_id')->unique()->nullable();
            $table->string('position')->default('Manager');
            $table->string('department')->nullable();
            $table->string('branch')->nullable();
            $table->string('reg_satus')->default('Pending');
            $table->string('role')->default('Employee');
            $table->decimal('salary', 10, 2)->default(500000);
            $table->decimal('leave_bal', 10, 2)->default(30);
            $table->date('hire_date')->default(DB::raw('CURRENT_DATE'));
            $table->enum('status', ['Approved', 'Blocked', 'Active', 'Inactive', 'Terminated'])->default('Active');
            $table->enum('employment_type', ['full-time', 'part-time', 'contract'])->default('full-time');
            $table->string('emergency_contact')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->default(12345678);
// Extra fields (with one underscore, 2-word max)
            $table->unsignedBigInteger('supervisor_id')->nullable();
            $table->date('contract_end')->nullable();
            $table->string('bank_acc')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('profile_pic')->nullable();
            $table->timestamp('last_login')->default(DB::raw('CURRENT_DATE'));
            $table->date('confirm_date')->nullable();
            $table->string('blood_type')->nullable();
            $table->string('disability_status')->nullable();
            $table->date('resign_date')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
