<?php

namespace Database\Seeders;

use App\Helpers\Referal;
use App\Models\Invitation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminInviteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Invitation::create([
            'code'       => Referal::generateReferralCode(10), // your helper function
            'created_by' => 1,        // Admin user id
            'single_use' => false,
            'max_uses'   => 100,
        ]);
    }
}
