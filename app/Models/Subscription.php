<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'phone',
        'status',
    ];

    public const IS_SUBSCRIBED = 'subscribed';
    public const IS_UNSUBSCRIBED = 'unsubscribed';

    public static function getArrayStatuses()
    {
        return [
            self::IS_SUBSCRIBED,
            self::IS_UNSUBSCRIBED
        ];
    }
}
