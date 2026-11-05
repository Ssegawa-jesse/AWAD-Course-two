<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
// Keep your other existing imports, including Jetstream's.

class User extends Authenticatable
{
   // use HasApiTokens;

    /** @use HasFactory<UserFactory> */
   use HasFactory;

  // use HasProfilePhoto;
    use HasRoles;          // Spatie: roles + permissions
    use Notifiable;
    //use TwoFactorAuthenticatable;

    public const STATUS_PENDING = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';

    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'account_type',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /* ---------------- Relationships ---------------- */

    public function student(): HasOne
    {
        return $this->hasOne(Student::class);
    }

    public function lecturer(): HasOne
    {
        return $this->hasOne(Lecturer::class);
    }

    /* ---------------- Helpers ---------------- */

    public function isApproved(): bool
    {
        return $this->status === self::STATUS_APPROVED;
    }

    /** Label shown in the header, e.g. "Registrar". */
    public function roleLabel(): string
    {
        return match (true) {
            $this->hasRole('admin') => 'Registrar',
            $this->hasRole('lecturer') => 'Lecturer',
            $this->hasRole('student') => 'Student',
            default => 'User',
        };
    }

    public function initials(): string
    {
        $name = preg_replace('/^(Dr|Mr|Ms|Mrs|Prof)\.?\s+/i', '', $this->name);

        return collect(preg_split('/\s+/', trim($name)))
            ->map(fn ($part) => mb_substr($part, 0, 1))
            ->take(2)
            ->implode('') ?: 'U';
    }
}


