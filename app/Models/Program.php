<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Relations\HasMany;

    class Program extends Model
    {
        use HasFactory;

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'programs_id', 'program_name'
        ];

        public function courses(): HasMany
        {
            return $this->hasMany(Course::class);
        }

        public function offers(): HasMany
        {
            return $this->hasMany(Offer::class);
        }

        public function dates(): Belongsto
        {
            return $this->belongsTo(Date::class);
        }
    }
