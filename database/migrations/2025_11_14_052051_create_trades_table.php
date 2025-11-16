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
        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            // Call or Put trade
            $table->enum('direction', ['Call', 'Put']);
            // Signal-based or self-trade
            $table->enum('trade_type', ['signal', 'self'])->default('self');
            // link to signal if user used one
            $table->foreignId('signal_id')->nullable()->constrained('signals')->nullOnDelete();
            // crypto symbol (BTC, ETH etc)
            $table->string('crypto_symbol', 10);
            // amount deducted from user wallet (1% of balance)
            $table->decimal('stake_amount', 20, 8);
            // Profit credited later after trade ends
            $table->decimal('profit_amount', 20, 8)->default(0);
            // Profit rate used for this trade (70-73%)
            $table->decimal('profit_rate', 10, 4)->default(0);
            // win/lose/pending
            $table->enum('result', ['win', 'lose', 'pending'])->default('pending');
            $table->timestamp('start_time');
            $table->timestamp('end_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trades');
    }
};
