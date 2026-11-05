<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Programme extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'name', 'faculty', 'level', 'duration_years', 'description',
    ];

    /** One programme has many students. */
    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    /** One programme has many courses (course units). */
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
