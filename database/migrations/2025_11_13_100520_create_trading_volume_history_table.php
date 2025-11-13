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
        Schema::create('trading_volume_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('volume_target', 20, 8);
            $table->decimal('volume_completed', 20, 8)->default(0);
            $table->decimal('volume_remaining', 20, 8);
            $table->decimal('transfer_amount', 20, 8); // Amount that triggered this volume
            $table->enum('status', ['active', 'completed', 'reset'])->default('active');
            $table->timestamp('completed_at')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trading_volume_history');
    }
};
