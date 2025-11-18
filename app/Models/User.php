<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Helpers\Referal;
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

    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }

    public function notifications()
    {
        return $this->hasMany(UserNotification::class);
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            if (empty($user->referral_code)) {
                $user->referral_code = Referal::generateReferralCode(8);
            }
        });
    }

    public function isActive()
    {
        return $this->account_status === 'active';
    }

    public function isDeactivated()
    {
        return $this->account_status === 'deactivated';
    }
}
