<?php

namespace API\Access\Users\Requests;

use Core\BaseRequest;
use Domain\Access\Users\DTO\UserDTO;

class UserCreateRequest extends BaseRequest
{

    protected array $access = [
        'permissions' => '',
        'roles' => '',
    ];

    protected array $decode = [];

    protected array $urlParameters = [];

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:4|max:255',
        ];
    }

    public function getData():UserDTO
    {
        return UserDTO::from([
                    'name' => $this->get('name'),
                    'email' => $this->get('email'),
                    'password' => $this->get('password'),
                ]);
    }

    public function authorize(): bool
    {
        return $this->check(['hasAccess']);
    }

}
