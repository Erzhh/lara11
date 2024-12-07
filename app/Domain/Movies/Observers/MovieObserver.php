<?php

namespace App\Domain\Movies\Observers;

use App\App\Services\ElasticsearchService;
use App\Domain\Movies\Models\Movie;
use Elastic\Elasticsearch\Client;

class MovieObserver
{
    protected Client $elasticsearch;

    public function __construct(ElasticsearchService $elasticsearchService)
    {
        $this->elasticsearch = $elasticsearchService->getClient();
    }

    /**
     * Handle the Movie "created" event.
     */
    public function creating(Movie $movie): void
    {
    }
    /**
     * Handle the Movie "created" event.
     */
    public function created(Movie $movie): void
    {
        $data = [
            'index' => $movie->getSearchIndex(),
            'type' => $movie->getSearchType(),
            'id' => $movie->id,
            'body' => $movie->toSearchArray(),
        ];
        $this->elasticsearch->index($data);
    }

    /**
     * Handle the Movie "updated" event.
     */
    public function updated(Movie $movie): void
    {
        $data = [
            'index' => $movie->getSearchIndex(),
            'type' => $movie->getSearchType(),
            'id' => $movie->id,
            'body' => $movie->toSearchArray(),
        ];
        $this->elasticsearch->update($data);
    }

    /**
     * Handle the Movie "updating" event.
     */
    public function updating(Movie $movie): void
    {
    }

    /**
     * Handle the Movie "deleted" event.
     */
    public function deleted(Movie $movie): void
    {
        $data = [
            'index' => $movie->getSearchIndex(),
            'type' => $movie->getSearchType(),
            'id' => $movie->id,
        ];
        $this->elasticsearch->delete($data);
    }

    /**
     * Handle the Movie "restored" event.
     */
    public function restored(Movie $movie): void
    {
    }
}
