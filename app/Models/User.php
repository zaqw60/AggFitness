<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;
    use CascadeSoftDeletes;

    protected $dates = ['deleted_at'];

    protected $cascadeDeletes = [
        'profile',
        'skill',
        'characteristic',
        'trainers',
        'gym',
        'gyms',
        'moderating'
        ];

    // define status here
    public const DRAFT = 'DRAFT';
    public const ACTIVE = 'ACTIVE';
    public const BLOCKED = 'BLOCKED';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role_id',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getArrayStatuses()
    {
        return [
            self::DRAFT,
            self::ACTIVE,
            self::BLOCKED
        ];
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class)->withTrashed();
    }

    public function skill(): HasOne
    {
        return $this->hasOne(Skill::class);
    }

    public function characteristic(): HasOne
    {
        return $this->hasOne(Characteristic::class);
    }

    public function gym(): HasOne
    {
        return $this->hasOne(Gym::class);
    }

    public function gyms(): BelongsToMany
    {
        return $this->belongsToMany(Gym::class, 'gym_reviews', 'client_id', 'gym_id')->withPivot('id', 'gym_id', 'title', 'description', 'score', 'status')->withTimestamps();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'relations')->withTimestamps();
    }

    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'trainer_reviews', 'trainer_id', 'client_id')->withPivot('id', 'client_id', 'title', 'description', 'score', 'status')->withTimestamps();
    }

    public function trainers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'trainer_reviews', 'client_id', 'trainer_id')->withPivot('id', 'trainer_id', 'title', 'description', 'score', 'status')->withTimestamps();
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function moderating(): HasOne
    {
        return $this->hasOne(Moderating::class);
    }
}
