<?php
namespace App\Console\Commands;

use App\App\Services\ElasticsearchService;
use Illuminate\Console\Command;
use Elastic\Elasticsearch\Client;

class DbRefreshCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh the database with the latest data from the API.';

    protected Client $elasticsearch;

    public function __construct(ElasticsearchService $elasticsearchService)
    {
        parent::__construct();
        $this->elasticsearch = $elasticsearchService->getClient();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->info('Start refreshing the database...');

        $this->call('migrate:refresh');
        $this->call('db:seed');
        $this->call('search:reindex');
        $this->call('optimize');

        $this->info('end refreshing the database.');
    }
}
