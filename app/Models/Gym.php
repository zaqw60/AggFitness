<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gym extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'phone_main',
        'phone_second',
        'email',
        'url',
        'description',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(GymAddress::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(GymImage::class);
    }

    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'gym_reviews', 'gym_id', 'client_id')->withPivot('id', 'client_id', 'title', 'description', 'score', 'status')->withTimestamps();
    }
}
