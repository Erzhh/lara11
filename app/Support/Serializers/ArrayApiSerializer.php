<?php

namespace App\Support\Serializers;

use InvalidArgumentException;
use League\Fractal\Resource\ResourceInterface;
use League\Fractal\Serializer\ArraySerializer as ParentSerializer;

class ArrayApiSerializer extends ParentSerializer
{
    /**
     * {@inheritDoc}
     */
    public function mergeIncludes(array $transformedData, array $includedData): array
    {
        $transformedData['included'] = $includedData;

        return $transformedData;
    }

    /**
     * {@inheritDoc}
     */
    public function includedData(ResourceInterface $resource, array $data): array
    {
        return $data;
    }

    /**
     * {@inheritDoc}
     */
    public function collection(?string $resourceKey, array $data): array
    {
        $resources = [];

        foreach ($data as $resource) {
            $resources[] = $this->item($resourceKey, $resource);
        }

        return ['data' => $resources];
    }

    /**
     * {@inheritDoc}
     */
    public function item(?string $resourceKey, array $data): array
    {
        $id = $this->getIdFromData($data);

        $resource = [
            'type' => $resourceKey,
            'id' => $id,
            'attributes' => $data,
            'included' => empty($data['included']) ? null : $data['included'],
        ];

        unset($resource['attributes']['id']);
        unset($resource['attributes']['included']);

        return $resource;
    }

    /**
     * @return mixed
     */
    #[\ReturnTypeWillChange]
    protected function getIdFromData(array $data)
    {
        if (! array_key_exists('id', $data)) {
            throw new InvalidArgumentException(
                'JSON API resource objects MUST have a valid id'
            );
        }

        return $data['id'];
    }
}
