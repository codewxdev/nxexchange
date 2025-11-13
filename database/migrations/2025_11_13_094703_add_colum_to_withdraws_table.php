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
        Schema::table('withdraws', function (Blueprint $table) {
            $table->decimal('net_amount', 20, 8); // Amount after fees
            $table->timestamp('approved_at')->nullable();
            $table->unsignedBigInteger('approved_by_admin_id')->nullable();
            $table->foreign('approved_by_admin_id')->references('id')->on('users')->onDelete('set null');

           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('withdraws', function (Blueprint $table) {
            //
        });
    }
};
