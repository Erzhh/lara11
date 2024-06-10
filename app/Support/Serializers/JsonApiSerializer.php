<?php

namespace App\Support\Serializers;

use League\Fractal\Serializer\JsonApiSerializer as ParentSerializer;

class JsonApiSerializer extends ParentSerializer
{
    /**
     * {@inheritDoc}
     */
    public function item(?string $resourceKey, array $data): array
    {
        $id = $this->getIdFromData($data);

        $resource = [
            'data' => [
                'type' => $resourceKey,
                'id' => $id,
                'attributes' => $data,
            ],
        ];

        unset($resource['data']['attributes']['id']);

        if (isset($resource['data']['attributes']['links'])) {
            $custom_links = $data['links'];
            unset($resource['data']['attributes']['links']);
        }

        if (isset($resource['data']['attributes']['meta'])) {
            $resource['data']['meta'] = $data['meta'];
            unset($resource['data']['attributes']['meta']);
        }

        if (empty($resource['data']['attributes'])) {
            $resource['data']['attributes'] = (object) [];
        }

        if ($this->shouldIncludeLinks()) {
            $resource['data']['links'] = [
                'self' => "{$this->baseUrl}/$resourceKey/$id",
            ];
            if (isset($custom_links)) {
                $resource['data']['links'] = array_merge($resource['data']['links'], $custom_links);
            }
        }

        return $resource;
    }
}
