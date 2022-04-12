<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'messages_id', 'tutors_id', 'students_id', 'courses_id', 'programs_id', 'date_time', 'offers_id', 'text'
    ];

    public function tutors(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tutors_id', 'id');
    }

    public function students(): Belongsto
    {
        return $this->belongsTo(User::class, 'students_id', 'id');
    }

    /*Date belongs to a program*/
    public function programs(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    /*Date belongs to an offer */
    public function offers(): BelongsTo
    {
        return $this->belongsTo(Offer::class);
    }

    /*Date belongs to a course */
    public function courses(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
