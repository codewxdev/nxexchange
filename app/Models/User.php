<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_card_number',
        'kyc_front_image',
        'kyc_back_image',
        'kyc_status',
        'level',
        'account_status',
        'referral_code',
        'referred_by',
        'wallet_address',
        'country',
        'referral_code',
        'referred_by',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'registered_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function notifications()
    {
        return $this->hasMany(UserNotification::class);
    }

    public function unreadNotifications()
    {
        return $this->notifications()->where('is_read', false);
    }

    // User model mein yeh relationships add karein
    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function trades()
    {
        return $this->hasMany(Trade::class); // Ya jo bhi aapka Trade model hai
    }

    public function getTradingVolumeData()
    {
        // Null safety - check if wallet exists
        if (! $this->wallet) {
            return $this->getDefaultVolumeData();
        }

        // Ensure float values with proper null handling
        $tradeBalance = (float) ($this->wallet->trade_balance ?? 0);
        $completedVolume = (float) ($this->trades()
            ->where('status', 'completed')
            ->sum('stake_amount') ?? 0);

        $targetVolume = $tradeBalance;
        $remainingVolume = max(0, $targetVolume - $completedVolume);

        // More precise calculation
        $progressPercentage = $targetVolume > 0 ?
            min(100, round(($completedVolume / $targetVolume) * 100, 2)) : 0;

        return [
            'trade_balance' => $tradeBalance,
            'target_volume' => $targetVolume,
            'completed_volume' => $completedVolume,
            'remaining_volume' => $remainingVolume,
            'progress_percentage' => $progressPercentage,
            'is_volume_complete' => $progressPercentage >= 100,
            'message' => $this->getVolumeStatusMessage($progressPercentage),
        ];
    }

    private function getDefaultVolumeData()
    {
        return [
            'trade_balance' => 0,
            'target_volume' => 0,
            'completed_volume' => 0,
            'remaining_volume' => 0,
            'progress_percentage' => 0,
            'is_volume_complete' => false,
            'message' => 'Wallet not found',
        ];
    }

    private function getVolumeStatusMessage($progressPercentage)
    {
        if ($progressPercentage >= 100) {
            return 'Trading volume completed! No deduction will be applied.';
        } elseif ($progressPercentage >= 75) {
            return 'Almost there! Complete your trading volume to avoid deductions.';
        } elseif ($progressPercentage >= 50) {
            return 'Halfway there! Keep trading to complete your volume.';
        } else {
            return 'Start trading to complete your volume requirement.';
        }
    }
}
