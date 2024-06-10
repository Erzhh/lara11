<?php

namespace Core;

use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository as Repository;

/**
 * Class BaseRepository.
 * @method static array list_with()
 */
abstract class BaseRepository extends Repository
{

    /*
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
