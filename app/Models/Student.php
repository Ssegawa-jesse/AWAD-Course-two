<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    public const STATUSES = ['Active', 'Suspended', 'Inactive', 'Graduated'];
    public const MODES = ['Day', 'Evening', 'Weekend'];
    public const SPONSORSHIPS = ['Private', 'Government', 'Scholarship'];
    public const GENDERS = ['Female', 'Male'];

    protected $fillable = [
        'user_id', 'programme_id', 'student_number', 'registration_number',
        'first_name', 'last_name', 'email', 'phone', 'gender', 'date_of_birth',
        'year_of_study', 'study_mode', 'sponsorship', 'status',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
        ];
    }

    /* ---------------- Relationships ---------------- */

    /** The login account of this student. */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** The programme the student is enrolled on. */
    public function programme(): BelongsTo
    {
        return $this->belongsTo(Programme::class);
    }

    /**
     * Courses the student has registered for (many-to-many through
     * the course_registrations pivot table).
     */
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_registrations')
            ->using(CourseRegistration::class)
            ->withPivot(['id', 'academic_year', 'semester', 'status', 'coursework_mark', 'exam_mark', 'grade'])
            ->withTimestamps();
    }

    /** The registration rows themselves. */
    public function registrations(): HasMany
    {
        return $this->hasMany(CourseRegistration::class);
    }

    /* ---------------- Scopes & helpers ---------------- */

    /** Only students that the registrar has approved (they have a number). */
    public function scopeEnrolled(Builder $query): Builder
    {
        return $query->whereNotNull('student_number');
    }

    public function getFullNameAttribute(): string
    {
        return trim($this->first_name.' '.$this->last_name);
    }

    public function getInitialsAttribute(): string
    {
        return mb_strtoupper(mb_substr($this->first_name, 0, 1).mb_substr($this->last_name, 0, 1));
    }

    public function totalCreditUnits(): int
    {
        return (int) $this->courses()->sum('credit_units');
    }

    /** Cumulative GPA from graded registrations (5-point scale). */
    public function gpa(): ?float
    {
        $graded = $this->registrations()->with('course')->whereNotNull('grade')->get();
        $units = $graded->sum(fn ($r) => $r->course->credit_units);

        if ($units === 0) {
            return null;
        }

        $points = $graded->sum(fn ($r) => CourseRegistration::gradePoint($r->grade) * $r->course->credit_units);

        return round($points / $units, 2);
    }

    /** Generate a unique 10-digit student number, e.g. 2600000012. */
    public static function nextStudentNumber(): string
    {
        $prefix = now()->format('y').'00';

        do {
            $number = $prefix.str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        } while (static::where('student_number', $number)->exists());

        return $number;
    }
}
