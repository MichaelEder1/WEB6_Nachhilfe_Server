<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Offer extends Model
{
    use HasFactory;

    /**
     * @var mixed|string
     */
    protected $fillable = [
        'title', 'information', 'isAvailable', 'offer_id', 'course_id', 'program_id', 'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /*Offer belongs to a course */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /*Offer belongs to a program */
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    /*Offer belongs to a date */
    public function dates(): BelongsTo
    {
        return $this->belongsTo(Date::class);
    }
}
