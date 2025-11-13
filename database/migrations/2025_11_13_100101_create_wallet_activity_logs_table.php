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
        Schema::create('wallet_activity_logs', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('user_id');
            $table->string('activity_type'); // deposit, withdrawal, transfer, adjustment, trade
            $table->text('description');
            $table->decimal('amount', 20, 8)->nullable();
            $table->string('account_affected')->nullable(); // exchange, trade
            $table->decimal('balance_before', 20, 8)->nullable();
            $table->decimal('balance_after', 20, 8)->nullable();
            $table->string('ip_address')->nullable();
            $table->text('metadata')->nullable(); // JSON for additional data

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallet_activity_logs');
    }
};
