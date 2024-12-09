<?php
namespace App\Console\Commands;

use App\App\Services\ElasticsearchService;
use App\Domain\Advert\Models\Advert;
use App\Domain\Movies\Models\Movie;
use Illuminate\Console\Command;
use Elastic\Elasticsearch\Client;

class ReindexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:reindex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Indexes all articles to Elasticsearch';

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

        $this->info('Indexing Movies to Elasticsearch...');
            foreach (Movie::cursor() as $movie)
            {
                $data = [
                    'index' => $movie->getSearchIndex(),
                    'type' => $movie->getSearchType(),
                    'id' => $movie->id,
                    'body' => $movie->toSearchArray(),
                ];
                $this->elasticsearch->index($data);
                $this->output->write('.');
            }
        $this->info('\nDone!');

        $this->info('Indexing Advert to Elasticsearch...');
            foreach (Advert::cursor() as $model)
            {
                $data = [
                    'index' => $model->getSearchIndex(),
                    'type' => $model->getSearchType(),
                    'id' => $model->id,
                    'body' => $model->toSearchArray(),
                ];
                $this->elasticsearch->index($data);
                $this->output->write('.');
            }
        $this->info('\nDone!');

    }
}
