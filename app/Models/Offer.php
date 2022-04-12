<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;

    class Offer extends Model
    {
        use HasFactory;

        protected $fillable = [
            'offers_id', 'courses_id', 'programs_id', 'users_id'
        ];

        public function users(): BelongsTo
        {
            return $this->belongsTo(User::class);
        }

        /*Offer belongs to a course */
        public function courses(): BelongsTo
        {
            return $this->belongsTo(Course::class);
        }

        /*Offer belongs to a program */
        public function programs(): BelongsTo
        {
            return $this->belongsTo(Program::class);
        }

        /*Offer belongs to a date */
        public function dates(): BelongsTo
        {
            return $this->belongsTo(Date::class);
        }
    }
