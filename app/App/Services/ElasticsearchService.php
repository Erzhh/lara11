<?php

namespace App\App\Services;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Transport\Exception\NoNodeAvailableException;

class ElasticsearchService
{
    protected Client $client;

    public function __construct()
    {
        $this->client = ClientBuilder::create()
                                    ->setHosts(config()->get('services.search.hosts'))
                                    ->build();

        $this->client->info();
    }

    public function getClient()
    {
        try {

            return $this->client;

        } catch (NoNodeAvailableException $e) {
            printf ("NoNodesAvailableException: %s\n", $e->getMessage());
        }
    }
}
