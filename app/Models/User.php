<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'profile_photo',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
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

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * Get a fully-qualified URL for the user's profile photo.
     *
     * Handles values that may be stored as a public `img/...` path
     * (legacy) or as a storage path like `profile-photos/...`.
     */
    public function getProfilePhotoUrlAttribute(): string
    {
        $pp = $this->profile_photo;

        if (! $pp) {
            return asset('img/girl.jpg');
        }

        // Absolute URL
        if (filter_var($pp, FILTER_VALIDATE_URL)) {
            return $pp;
        }

        // Public img/ or images/ paths (legacy/public assets)
        if (Str::startsWith($pp, ['img/', '/img/', 'images/', '/images/'])) {
            return asset(ltrim($pp, '/'));
        }

        // Default: treat as storage path (stored via $file->store('profile-photos','public'))
        return asset('storage/' . ltrim($pp, '/'));
    }
}
