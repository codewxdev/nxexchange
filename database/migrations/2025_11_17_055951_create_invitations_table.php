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
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->string('code', 32)->unique();        // invite code used at registration
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete(); // who created this invite (admin or user)
            $table->boolean('single_use')->default(true); // single use or reusable
            $table->unsignedInteger('max_uses')->nullable(); // null = unlimited (if single_use = false)
            $table->unsignedInteger('uses')->default(0);
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
