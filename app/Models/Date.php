<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Date extends Model
{
    use HasFactory;


    public function tutors():BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'tutors_id');
    }

    public function seekers():Belongsto
    {
        return $this->belongsTo(User::class, 'id', 'seekers_id');
    }

    /*Date belongs to a program*/
    public function programs():BelongsTo{
        return $this->belongsTo(Program::class);
    }

    /*Date belongs to an offer */
    public function offers():BelongsTo{
        return $this->belongsTo(Offer::class);
    }

    /*Date belongs to a course */
    public function courses():BelongsTo{
        return $this->belongsTo(Course::class);
    }
}
