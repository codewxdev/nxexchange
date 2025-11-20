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
            $table->decimal('net_amount', 16, 2)->nullable()->change();
            $table->string('address')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('withdraws', function (Blueprint $table) {
            $table->decimal('net_amount', 16, 2)->nullable(false)->change();
            $table->string('address')->nullable(false)->change();
            
        });
    }
};
