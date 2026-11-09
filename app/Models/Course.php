<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    public const TYPES = ['Core', 'Elective'];
    public const DAYS = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

    protected $fillable = [
        'programme_id', 'lecturer_id', 'code', 'title', 'description',
        'credit_units', 'year_of_study', 'semester', 'type', 'capacity',
        'day', 'start_time', 'end_time', 'room',
    ];

    /* ---------------- Relationships ---------------- */

    public function programme(): BelongsTo
    {
        return $this->belongsTo(Programme::class);
    }

    /** The lecturer assigned to teach this course. */
    public function lecturer(): BelongsTo
    {
        return $this->belongsTo(Lecturer::class);
    }

    /** Students registered for this course (many-to-many). */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'course_registrations')
            ->using(CourseRegistration::class)
            ->withPivot(['id', 'academic_year', 'semester', 'status', 'coursework_mark', 'exam_mark', 'grade'])
            ->withTimestamps();
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(CourseRegistration::class);
    }

    /* ---------------- Helpers ---------------- */

    public function isFull(): bool
    {
        $count = $this->registrations_count ?? $this->registrations()->count();

        return $count >= $this->capacity;
    }

    public function scheduleLabel(): string
    {
        if (! $this->day) {
            return 'Not scheduled';
        }

        $time = $this->start_time ? substr($this->start_time, 0, 5).'–'.substr((string) $this->end_time, 0, 5) : '';

        return trim($this->day.' '.$time);
    }
}
