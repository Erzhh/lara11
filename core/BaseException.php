<?php

namespace Core;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BaseException extends HttpException
{

    protected $code = Response::HTTP_BAD_REQUEST;
    protected $message =  'Ошибка';

    public function __construct( )
    {
        parent::__construct($this->code, $this->message,null,[],0);
    }

}
