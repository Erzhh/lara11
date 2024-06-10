<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client;

class CacheAirports extends Command
{
    protected $signature = 'cache:airports';
    protected $description = 'Fetch and cache airport data';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $client = new Client();
        $response = $client->get('https://raw.githubusercontent.com/NemoTravel/nemo.travel.geodata/master/airports.json');
        $airports = json_decode($response->getBody(), true);

        Cache::put('airports', $airports, 60*60*24); // Cache for 24 hours

        $this->info('Airports data cached successfully.');
    }

}
