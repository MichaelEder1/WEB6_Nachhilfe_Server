<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course_id', 'course_name', 'semester', 'program_id', 'code', 'image', 'description'
    ];

    /*Course belongs to a program */
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }

    public function dates(): HasMany
    {
        return $this->hasMany(Date::class);
    }
}
