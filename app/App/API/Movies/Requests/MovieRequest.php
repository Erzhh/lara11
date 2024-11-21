<?php

namespace API\Movies\Requests;

use Core\BaseRequest;

class MovieRequest extends BaseRequest
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
            'query' => 'nullable|string|max:255',
        ];
    }

    public function getQuery(): string
    {
        return $this->validated('query')??'';
    }

    public function authorize(): bool
    {
        return $this->check(['hasAccess']);
    }

}
