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
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->boolean('status')->nullable()->default('1');
            $table->string('package')->nullable();
            $table->foreignId('role_id')->nullable()->default('2')->constrained()->onDelete('cascade');
            $table->foreignId('package_id')->nullable()->constrained()->onDelete('cascade');
            $table->dateTime('package_due_date')->nullable();
            $table->string('profile_pic')->nullable();
            $table->timestamps();
            $table->timestamp('last_login_time')->nullable();
            $table->string('last_login_ip')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
