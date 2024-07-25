<?php

namespace Domain\Access\Users\DTO;

use Illuminate\Support\Facades\Hash;
use Spatie\LaravelData\Data;

class UserDTO extends Data
{

    public string $name;
    public string $email;
    public string $password;

    public function getHashPass(): string
    {
        return Hash::make($this->password);
    }

}
