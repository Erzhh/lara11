<?php

namespace App\Domain\Movies\Tasks;

use App\Domain\Movies\Models\Movie;
use Illuminate\Database\QueryException;

class CreateMovieByIdTask
{
    public function run(array $data)
    {
        try {
            return Movie::query()->create($data);

        } catch (QueryException $e) {
            throw new \Exception($e->getMessage());
        }
        catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }
}
