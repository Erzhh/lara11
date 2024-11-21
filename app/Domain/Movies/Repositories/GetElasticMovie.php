<?php

namespace App\Domain\Movies\Repositories;

use App\App\Services\ElasticsearchService;
use App\Domain\Movies\Models\Movie;
use Elastic\Elasticsearch\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class GetElasticMovie
{
    /** @var Client */
    protected Client $elasticsearch;

    public function __construct(ElasticsearchService $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch->getClient();
    }
    public function run(string $query = '')
    {
        $items = $this->searchOnElasticsearch($query);
        return $this->buildCollection($items);
    }
    private function searchOnElasticsearch(string $query = '')
    {
        $model = new Movie();
        $items = $this->elasticsearch->search([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'body' => [
                'query' => [
                    'multi_match' => [
                        'fields' => ['movie', 'overview'],
                        'query' => $query,
                    ],
                ],
            ],
        ]);
        return $items;
    }
    private function buildCollection( $items): Collection
    {
        $ids = Arr::pluck($items['hits']['hits'], '_id');
        return Movie::query()->whereIn('rating',$ids)->get();
    }
}
