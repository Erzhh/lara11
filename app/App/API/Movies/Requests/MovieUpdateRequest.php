<?php

namespace API\Movies\Requests;

use Core\BaseRequest;

class MovieUpdateRequest extends BaseRequest
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
            'movie' => 'required|string|max:255',
            'year' => 'required|integer',
            'country' => 'required|string|max:255',
            'rating_ball' => 'required|decimal:1,4',
            'overview' => 'required|string|max:1000',
            'director' => 'required|string|max:100',
            'screenwriter' => 'required|string|max:1000',
            'actors' => 'required|string|max:1000',
            'url_logo' => 'required|string|max:255',
        ];
    }

    public function getData(): array
    {
        return [
            'movie' => $this->validated('movie'),
            'year' => $this->validated('year'),
            'country' => $this->validated('country'),
            'rating_ball' => $this->validated('rating_ball'),
            'overview' => $this->validated('overview'),
            'director' => $this->validated('director'),
            'screenwriter' => $this->validated('screenwriter'),
            'actors' => $this->validated('actors'),
            'url_logo' => $this->validated('url_logo'),
        ];
    }

    public function authorize(): bool
    {
        return $this->check(['hasAccess']);
    }

}
