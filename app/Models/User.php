<?php

    namespace App\Models;

    use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;

    class User extends Authenticatable
    {
        use HasFactory, Notifiable;

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'user_id', 'first_name', 'last_name', 'age', 'photo', 'mail', 'password', 'phone_number', 'education', 'degree', 'semester', 'role', 'tutors_id', 'students_id'
        ];

        /**
         * The attributes that should be hidden for arrays.
         *
         * @var array
         */
        protected $hidden = [
            'password', 'remember_token',
        ];

        /**
         * The attributes that should be cast to native types.
         *
         * @var array
         */
        protected $casts = [
            'email_verified_at' => 'datetime',
        ];

        public function offers(): HasMany
        {
            return $this->hasMany(Offer::class);
        }

        public function students(): HasMany
        {
            return $this->hasMany(User::class, 'students_id', 'id');
        }

        public function tutors(): HasMany
        {
            return $this->hasMany(User::class, 'tutors_id', 'id');
        }
    }
