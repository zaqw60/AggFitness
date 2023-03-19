<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Moderating extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    // define status here
    public const IS_PENDING = 'IS_PENDING';
    public const IS_APPROVED = 'IS_APPROVED';
    public const IS_REJECTED = 'IS_REJECTED';

    public const REASON00 = '';
    public const REASON01 = 'анкета содержит некорректные данные';
    public const REASON02 = 'анкета создана автоматически';
    public const REASON03 = 'анкета содержит недопустимые материалы';
    public const REASON04 = 'анкета содержит рекламные материалы';
    public const REASON05 = 'аккаунт заблокирован по жалобам других пользователей';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'status',
        'reason'
    ];

    public static function getArrayStatuses()
    {
        return [
            self::IS_PENDING,
            self::IS_APPROVED,
            self::IS_REJECTED
        ];
    }

    public static function getArrayReasons()
    {
        return [
            self::REASON00,
            self::REASON01,
            self::REASON02,
            self::REASON03,
            self::REASON04,
            self::REASON05
        ];
    }

    /**
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     *
     * @return BelongsTo
     */
    public function profile(): HasOne
    {
        return $this->HasOne(Profile::class, 'user_id', 'user_id');
    }

    /**
     *
     * @return BelongsTo
     */
    public function skill(): HasOne
    {
        return $this->HasOne(Skill::class, 'user_id', 'user_id');
    }

    /**
     * Получить tag
     */
    public function tags()
    {
        return $this->HasManyThrough(
            Tag::class,
            Relation::class,
            'user_id',
            'id',
            'user_id',
            'tag_id'
        );
    }

    /**
     * Получить characteristic
     */
    public function characteristic()
    {
        return $this->HasOne(Characteristic::class, 'user_id', 'user_id');
    }

    /**
     * Получить gym
     */
    public function gym()
    {
        return $this->HasOne(Gym::class, 'user_id', 'user_id');
    }

    /**
     * Получить gymAddresses
     */
    public function gymAddresses()
    {
        return $this->hasManyThrough(
            GymAddress::class,
            Gym::class,
            'id', // Внешний ключ в таблице `gyms` ...
            'gym_id', // Внешний ключ в таблице `GymAddresses` ...
            'id', // Локальный ключ в таблице `GymAddresses` ...
            'user_id' // Локальный ключ в таблице `gyms` ...
        );
    }

    /**
     * Получить gymAImages
     */
    public function gymImages()
    {
        return $this->hasManyThrough(
            GymImage::class,
            Gym::class,
            'id', // Внешний ключ в таблице `gyms` ...
            'gym_id', // Внешний ключ в таблице `GymImages` ...
            'id', // Локальный ключ в таблице `GymImages` ...
            'id' // Локальный ключ в таблице `gyms` ...
        );
    }
}
