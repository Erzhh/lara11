<?php

namespace App\Domain\Access\Users\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\SoftDeletes;

class User extends Model implements Authenticatable
{
    use SoftDeletes;

    protected $connection = 'mongodb';

    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password'];

    function getAuthIdentifierName()
    {
        // TODO: Implement getAuthIdentifierName() method.
    }

    public function getAuthIdentifier()
    {
        // TODO: Implement getAuthIdentifier() method.
    }

    public function getAuthPasswordName()
    {
        // TODO: Implement getAuthPasswordName() method.
    }

    public function getAuthPassword()
    {
        // TODO: Implement getAuthPassword() method.
    }

    public function getRememberToken()
    {
        // TODO: Implement getRememberToken() method.
    }

    public function setRememberToken($value)
    {
        // TODO: Implement setRememberToken() method.
    }

    public function getRememberTokenName()
    {
        // TODO: Implement getRememberTokenName() method.
    }

}
