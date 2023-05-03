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
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role');
            $table->rememberToken();
            $table->timestamps();

            $table->foreignId('payment_id')
                ->nullable()
                ->constrained('payments')
                ->onDelete('set null');

            $table->foreignId('level_id')
                ->nullable()
                ->constrained('levels')
                ->onDelete('set null');

            $table->foreignId('sale_id')
                ->nullable()
                ->constrained('sales')
                ->onDelete('set null');

            $table->foreignId('goal_id')
                ->nullable()
                ->constrained('goals')
                ->onDelete('set null');
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
