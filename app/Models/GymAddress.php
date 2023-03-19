<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Relations\BelongsTo;
//use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class GymAddress extends Model
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
        'gym_id',
        'index',
        'country',
        'city',
        'street',
        'house_number',
        'building',
        'floor',
        'apartment',
    ];

    public function gym()
    {
        return $this->belongsTo(Gym::class)->withTrashed();
    }

    public function gymOwner()
    {
        return $this->hasOneThrough(
            User::class,
            Gym::class,
            'user_id',
            'id',
            'gym_id',
            'user_id'
            );
    }
}
