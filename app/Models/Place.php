<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'bot_id',
        'category_id',
        'name',
        'description',
        'address',
        'phone_number',
        'opening_hours',
        'instagram',
        'yandex_maps',
    ];

    public function bot(): BelongsTo
    {
        return $this->belongsTo(TelegraphBot::class, 'bot_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(PlaceCategory::class, 'category_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(PlaceImage::class);
    }
}
