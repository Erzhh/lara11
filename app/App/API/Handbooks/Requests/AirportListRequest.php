<?php

namespace API\Handbooks\Requests;

use Core\BaseRequest;
use Domain\Handbooks\Airports\DTO\AirportFilterDTO;

class AirportListRequest extends BaseRequest
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
            'query' => 'nullable|string|max:255'
        ];
    }

    public function getData():AirportFilterDTO
    {
        return AirportFilterDTO::from([
                    'name' => $this->get('query')
                ]);
    }

    public function authorize(): bool
    {
        return $this->check(['hasAccess']);
    }

}
