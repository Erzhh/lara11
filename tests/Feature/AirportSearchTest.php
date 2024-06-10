<?php

namespace Tests\Feature;

use Tests\TestCase;

class AirportSearchTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('cache:airports');
    }

    public function test_search_airports()
    {
        $response = $this->get('/api/airports?query=New');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['cityName', 'airportName', 'area', 'country', 'lat','lng','timezone']
        ]);
    }

    public function test_search_airports_no_query()
    {
        $response = $this->get('/api/airports');
        $response->assertStatus(200);
    }

    public function test_search_airports_not_exists_name()
    {
        $response = $this->get('/api/airports?query=NoPort');
        $response->assertStatus(200);
        $response->assertJsonCount(0);
    }

}
