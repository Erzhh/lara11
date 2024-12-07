<?php
namespace App\Console\Commands;

use App\App\Services\ElasticsearchService;
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
        $this->info('Indexing all articles. This might take a while...');

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
    }
}
