<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 30; $i++) {

            User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'unique_id' => strtoupper(Str::random(10)),
                'password' => Hash::make('password123'),
                'level' => rand(0, 5),
                'account_status' => fake()->randomElement(['active', 'locked', 'deactivated']),
                'avatar' => null,
                'kyc_status' => fake()->randomElement([
                    'not_verified', 'pending', 'verified', 'rejected',
                ]),
                'country' => fake()->country(),
                'id_card_number' => fake()->randomNumber(8, true),
                'kyc_front_image' => null,
                'kyc_back_image' => null,
                'referral_code' => strtoupper(Str::random(6)),
                'referred_by' => null,
                'exchange_balance' => fake()->randomFloat(2, 0, 5000),
                'trade_balance' => fake()->randomFloat(2, 0, 3000),
                'trading_volume_target' => fake()->randomFloat(2, 100, 50000),
                'trading_volume_completed' => fake()->randomFloat(2, 0, 50000),
                'withdraw_address' => fake()->uuid(),
                'device_type' => fake()->randomElement(['android', 'ios', 'web']),
                'ip_address' => fake()->ipv4(),
                'last_login_ip' => fake()->ipv4(),
                'last_login_at' => fake()->dateTimeBetween('-30 days', 'now'),
                'manual_adjusted_by' => null,
                'remarks' => fake()->sentence(),
                'registered_at' => now(),
                'role' => fake()->randomElement(['user', 'admin']),
                'referrals_count' => rand(0, 50),
            ]);
        }
    }
}
