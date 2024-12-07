<?php

namespace App\Domain\Movies\Tasks;

use App\Domain\Movies\Models\Movie;
use Illuminate\Database\QueryException;

class DeleteMovieByIdTask
{
    public function run(int $id): int
    {
        try {
            return Movie::destroy($id);

        } catch (QueryException $e) {
            throw new \Exception($e->getMessage());
        }
        catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }
}
