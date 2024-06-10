<?php

namespace Core\Exceptions;

use Core\BaseException;
use Symfony\Component\HttpFoundation\Response;

class QueryBuilderException extends BaseException
{

    protected $code = Response::HTTP_BAD_REQUEST;
    protected $message =  'HTTP BAD REQUEST';

}
