<?php

namespace App\Domain\Patterns\Singleton\Traits;

trait SingletonTrait
{
    private static $instance = null;

    private function __construct()
    {}

    public function __clone(): void
    {}

    public static function getInstance()
    {
        return static::$instance ?? ( static::$instance= new static());
    }

}
