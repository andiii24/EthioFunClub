<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('phone')->Unique();
            $table->string('name');
            $table->string('password');
            $table->bigInteger('role');
            $table->string('image')->nullable();
            $table->bigInteger('status')->default('0');
            $table->bigInteger('level')->default('0');
            $table->bigInteger('password_reset')->default('0');
            $table->bigInteger('level_payment')->default('0');
            $table->bigInteger('request_payment')->default('0');
            $table->foreignId('upid')->nullable()->constrained('users');
            $table->foreignId('left_child_id')->nullable()->constrained('users');
            $table->foreignId('middle_child_id')->nullable()->constrained('users');
            $table->foreignId('right_child_id')->nullable()->constrained('users');

            $table->rememberToken();
            $table->timestamps();

        });
    }
};
