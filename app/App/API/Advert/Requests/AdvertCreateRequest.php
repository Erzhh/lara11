<?php

namespace API\Advert\Requests;

use App\Domain\Advert\DTO\AdvertPointDTO;
use Core\BaseRequest;
use Domain\Advert\DTO\AdvertDTO;

class AdvertCreateRequest extends BaseRequest
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
            'title' => 'required|string|max:255',
            'price' => 'required|float|min:0',
            'room' => 'required|integer|min:0|max:40',
            'level' => 'required|integer|min:0|max:100',
            'latitude' => 'required|between:-90,90',
            'longitude' => 'required|between:-180,180'
        ];
    }

    public function getData(): AdvertDTO
    {
        return AdvertDTO::from([
            'title' => $this->get('title'),
            'price' => $this->get('price'),
            'room' => $this->get('room'),
            'level' => $this->get('level'),
            'location' => AdvertPointDTO::from([
                'latitude' => $this->get('latitude'),
                'longitude' => $this->get('longitude'),
            ])
        ]);
    }

    public function messages(): array
    {
        return [
            'latitude.between' => 'The latitude must be in range between -90 and 90',
            'longitude.between' => 'The longitude mus be in range between -180 and 180'
        ];
    }

    public function authorize(): bool
    {
        return $this->check(['hasAccess']);
    }
}
