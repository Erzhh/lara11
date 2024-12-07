<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $file_path = resource_path('database/movies_top_250.sql');

        DB::unprepared( file_get_contents($file_path) );
    }
}
