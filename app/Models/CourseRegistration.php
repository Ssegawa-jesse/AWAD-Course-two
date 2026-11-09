<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Pivot model for the course_registrations table.
 * Used by Student::courses() and Course::students() (belongsToMany ->using()).
 */
class CourseRegistration extends Pivot
{
    protected $table = 'course_registrations';

    public $incrementing = true;

    protected $fillable = [
        'student_id', 'course_id', 'academic_year', 'semester', 'status',
        'coursework_mark', 'exam_mark', 'grade',
    ];

    protected function casts(): array
    {
        return [
            'coursework_mark' => 'float',
            'exam_mark' => 'float',
        ];
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function total(): ?float
    {
        if ($this->coursework_mark === null && $this->exam_mark === null) {
            return null;
        }

        return (float) $this->coursework_mark + (float) $this->exam_mark;
    }

    /** Grade from a total mark out of 100. */
    public static function gradeFor(?float $total): ?string
    {
        if ($total === null) {
            return null;
        }

        return match (true) {
            $total >= 80 => 'A',
            $total >= 75 => 'B+',
            $total >= 70 => 'B',
            $total >= 65 => 'C+',
            $total >= 60 => 'C',
            $total >= 55 => 'D+',
            $total >= 50 => 'D',
            default => 'F',
        };
    }

    public static function gradePoint(?string $grade): float
    {
        return match ($grade) {
            'A' => 5.0, 'B+' => 4.5, 'B' => 4.0, 'C+' => 3.5,
            'C' => 3.0, 'D+' => 2.5, 'D' => 2.0, default => 0.0,
        };
    }
}
