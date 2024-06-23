<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
    ];

    /**
     * The attributes that must be loaded.
     *
     * @var array<int, string>
     */
    protected $with = [
        'telegramUser',
    ];

    public function telegramUser(): HasOne
    {
        return $this->hasOne(TelegramUser::class);
    }
}
