<?php

namespace App\Domain\Movies\Tasks;

use App\Domain\Movies\Models\Movie;
use Illuminate\Database\QueryException;

class UpdateMovieByIdTask
{
    public function run(int $id, array $data)
    {
        try {
            $movie = Movie::findOrFail($id);
            $movie->update($data);

            return $movie;

        } catch (QueryException $e) {
            throw new \Exception($e->getMessage());
        }
        catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }
}
