<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'message_id', 'tutor_id', 'student_id', 'course_id', 'program_id', 'date_time', 'offer_id', 'text'
    ];

    public function tutor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tutor_id', 'id');
    }

    public function student(): Belongsto
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    /*Date belongs to a program*/
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    /*Date belongs to an offer */
    public function offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class);
    }

    /*Date belongs to a course */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
