<?php

namespace App\Domain\Movies\Repositories;

use App\App\Services\ElasticsearchService;
use App\Domain\Movies\Models\Movie;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\Response\Elasticsearch;
use Http\Promise\Promise;
use Illuminate\Database\Eloquent\Collection;

class GetElasticMovie
{
    /** @var Client */
    protected Client $elasticsearch;

    public function __construct(ElasticsearchService $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch->getClient();
    }

    public function run(string $query = ''): Collection
    {
        $items = $this->searchOnElasticsearch($query);
        return $this->buildCollection($items);
    }

    public function searchIds(string $query = ''): array
    {
        $items = $this->searchOnElasticsearch($query);
        return $this->getIds($items);
    }

    private function searchOnElasticsearch(string $query = ''): Elasticsearch|Promise
    {
        $query = strtolower($query);

        $model = new Movie();
        $items = $this->elasticsearch->search([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'body' => [
                'query' => [
                    'bool' => [
                        'should' => [
                            [
                                'multi_match' => [
                                    'query' => $query,
                                    'fields' => ['movie^4', 'overview^3'],
                                    'type' => 'best_fields',
                                    'operator' => 'or'
                                ]
                            ],
                        ]
                    ]
                ]
            ],
        ]);

        return $items;
    }

    private function buildCollection($items): Collection
    {
        $ids = $this->getIds($items);
        return Movie::query()->whereIn('id', $ids)->get();
    }

    private function getIds($items): array
    {
        return collect($items['hits']['hits'])
                ->sortByDesc('_score')
                ->pluck('_id')
                ->toArray();
    }
}
