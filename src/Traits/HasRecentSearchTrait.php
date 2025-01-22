<?php

namespace Spatie\Searchable\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Spatie\Searchable\RecentSearch;

trait HasRecentSearchTrait
{
    /**
     * Get all recent searches for this model type
     */
    public function recentSearches(): MorphMany
    {
        return $this->morphMany(RecentSearch::class, 'searchable');
    }

    /**
     * Store a recent search for this model type
     */
    public static function storeRecentSearch(string $query): void
    {
        RecentSearch::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'query' => $query,
                'searchable_type' => static::class
            ],
            [
                'last_searched_at' => Carbon::now()
            ]
        );
    }

    /**
     * Get recent searches for this model type
     */
    public static function getRecentSearches(int $limit = config('recentsearch.recent_search_limit'))
    {
        return RecentSearch::forUser(Auth::id())
            ->forType(static::class)
            ->orderBy('last_searched_at', 'desc')
            ->take($limit)
            ->get();
    }

    /**
     * Clear recent searches for this model type
     */
    public static function clearRecentSearches(): void
    {
        RecentSearch::forUser(Auth::id())
            ->forType(static::class)
            ->delete();
    }

    public static function deleteRecentSearchRecord($id): void
    {
        RecentSearch::forUser(Auth::id())
            ->forType(static::class)
            ->where('id', $id)->delete();
    }
}