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
        Schema::table('transfers', function (Blueprint $table) {
            $table->boolean('deduction_applied')->default(false);
            $table->decimal('net_amount', 20, 8); // Amount after fees
            $table->decimal('trading_volume_at_transfer', 20, 8)->default(0);
            $table->decimal('trading_volume_completed_at_transfer', 20, 8)->default(0);
            $table->string('trading_volume_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transfers', function (Blueprint $table) {
            //
        });
    }
};
