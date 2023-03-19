<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    public const MALE = 'male';
    public const FEMALE = 'female';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'father_name',
        'age',
        'gender',
        'image'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function skill(): BelongsTo
    {
        // user_id модели Profile ссылается на user_id модели Skill
        return $this->belongsTo(Skill::class, 'user_id', 'user_id');
    }

    public function characteristic(): BelongsTo
    {
        // user_id модели Profile ссылается на user_id модели Characteristic
        return $this->belongsTo(Characteristic::class, 'user_id', 'user_id');
    }

    public function moderating(): BelongsTo
    {
        // user_id модели Profile ссылается на user_id модели Moderating
        return $this->belongsTo(Moderating::class, 'user_id', 'user_id');
    }
}
