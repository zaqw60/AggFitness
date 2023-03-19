<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Characteristic extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    // define health here
    /*
     * Группы здоровья для ENUM['health']:
     * А – Возможны занятия физической культурой без ограничений и участие в соревнованиях.
     * B – Возможны занятия физической культурой с незначительными ограничениями физических нагрузок без участия в соревнованиях.
     * C - Возможны занятия физической культурой со значительными ограничениями физических нагрузок.
     * D – Возможны занятия только лечебной физкультурой.
    */

    public const HEALTH_A = 'A';
    public const HEALTH_B = 'B';
    public const HEALTH_C = 'C';
    public const HEALTH_D = 'D';

    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'location',
        'height',
        'weight',
        'health',
        'description',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function profile(): HasOne
    {
        // user_id модели Skill ссылается на user_id модели Profile
        return $this->hasOne(Profile::class, 'user_id', 'user_id');
    }
}
