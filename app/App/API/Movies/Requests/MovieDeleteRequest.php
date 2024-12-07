<?php

namespace API\Movies\Requests;

use Core\BaseRequest;

class MovieDeleteRequest extends BaseRequest
{
    protected array $access = [
        'permissions' => '',
        'roles' => '',
    ];

    protected array $decode = [];

    protected array $urlParameters = [
        'id'
    ];

    public function rules(): array
    {
        return [
            'id' => 'required|integer',
        ];
    }

    public function getId(): int
    {
        return $this->validated('id');
    }

    public function authorize(): bool
    {
        return $this->check(['hasAccess']);
    }
}
