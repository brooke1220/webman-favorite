<?php

namespace Brooke1220\WebmanFavorite;

use Brooke1220\WebmanFavorite\Events\Favorited;
use Brooke1220\WebmanFavorite\Events\Unfavorited;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @property \Illuminate\Database\Eloquent\Model $user
 * @property \Illuminate\Database\Eloquent\Model $favoriter
 * @property \Illuminate\Database\Eloquent\Model $favoriteable
 */
class Favorite extends Model
{
    protected $guarded = [];

    protected $dispatchesEvents = [
        'created' => Favorited::class,
        'deleted' => Unfavorited::class,
    ];

    public function __construct(array $attributes = [])
    {
        $this->connection = config('plugin.brooke1220.webman-favorite.app.database_connection');
        $this->table = config('plugin.brooke1220.webman-favorite.app.favorites_table');

        parent::__construct($attributes);
    }

    protected static function boot()
    {
        parent::boot();

        self::saving(function ($favorite) {
            if (\config('plugin.brooke1220.webman-favorite.app.uuids')) {
                $favorite->{$favorite->getKeyName()} = $favorite->{$favorite->getKeyName()} ?: (string) Str::orderedUuid();
            }
        });
    }

    public function favoriteable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(config('plugin.brooke1220.webman-favorite.app.user_model'), \config('plugin.brooke1220.webman-favorite.app.user_foreign_key'));
    }

    public function favoriter(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->user();
    }

    public function scopeWithType(Builder $query, string $type): Builder
    {
        return $query->where('favoriteable_type', \support\Container::get($type)->getMorphClass());
    }
}
