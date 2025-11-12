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
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('from_account', ['exchange', 'trade']);
            $table->enum('to_account', ['exchange', 'trade']);
            $table->decimal('amount', 16, 8);
            $table->decimal('deduction', 16, 8)->nullable();
            $table->enum('status', ['pending', 'completed'])->default('pending');
            $table->timestamp('date_time')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfers');
    }
};
