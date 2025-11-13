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
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->decimal('exchange_account_balance', 20, 8)->default(0);
            $table->decimal('trade_account_balance', 20, 8)->default(0);
            $table->decimal('trading_volume_target', 20, 8)->default(0);
            $table->decimal('trading_volume_completed', 20, 8)->default(0);
            $table->string('withdrawal_address')->nullable();
            $table->string('withdrawal_password')->nullable();
            $table->string('withdrawal_network')->default('TRC-20');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
