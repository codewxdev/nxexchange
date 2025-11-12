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
        Schema::table('users', function (Blueprint $table) {
            $table->string('unique_id')->unique()->after('email')->nullable(); // e.g. NX12345
            $table->unsignedTinyInteger('level')->default(0);
            $table->enum('account_status', ['active', 'locked', 'deactivated'])->default('active');
            $table->string('avatar')->nullable();

            // KYC & Profile Info
            $table->enum('kyc_status', ['not_verified', 'pending', 'verified', 'rejected'])->default('not_verified');
            $table->string('country')->nullable();
            $table->string('id_card_number')->nullable();
            $table->string('kyc_front_image')->nullable();
            $table->string('kyc_back_image')->nullable();

            // Referral System
            $table->string('referral_code')->unique()->nullable();
            $table->string('referred_by')->nullable();


            // Wallets & Balances
            $table->decimal('exchange_balance', 16, 2)->default(0);
            $table->decimal('trade_balance', 16, 2)->default(0);
            $table->decimal('trading_volume_target', 16, 2)->default(0);
            $table->decimal('trading_volume_completed', 16, 2)->default(0);
            $table->string('withdraw_address')->nullable();

            // Security & Login Tracking
            $table->string('device_type')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->timestamp('last_login_at')->nullable();

            // Admin Management Fields
            $table->string('manual_adjusted_by')->nullable();
            $table->text('remarks')->nullable();

            // Timestamps
            $table->timestamp('registered_at')->useCurrent();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
