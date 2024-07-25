<?php

namespace API\Access\Users\Requests;

use App\Domain\Access\Users\DTO\UserUpdateDataDTO;
use Core\BaseRequest;

class UserUpdateRequest extends BaseRequest
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
        ];
    }

    public function getData():UserUpdateDataDTO
    {
        return UserUpdateDataDTO::from([
                    'name' => $this->get('name'),
                ]);
    }

    public function authorize(): bool
    {
        return $this->check(['hasAccess']);
    }

}
