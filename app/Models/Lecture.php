<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Lecturer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'staff_number', 'title', 'department',
        'qualification', 'employment_type', 'phone',
    ];

    /** The login account of this lecturer. */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** Courses assigned to this lecturer. */
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    /** All registrations in this lecturer's courses. */
    public function registrations(): HasManyThrough
    {
        return $this->hasManyThrough(CourseRegistration::class, Course::class);
    }

    public function getNameAttribute(): string
    {
        return $this->user?->name ?? 'Unknown lecturer';
    }

    /** Generate the next staff number, e.g. STF-2026-0007. */
    public static function nextStaffNumber(): string
    {
        $year = now()->year;
        $count = static::whereNotNull('staff_number')->count() + 1;

        do {
            $number = sprintf('STF-%d-%04d', $year, $count++);
        } while (static::where('staff_number', $number)->exists());

        return $number;
    }
}
