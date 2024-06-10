<?php

namespace Core;

use ErrorException;
use Exception;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Primitive;
use League\Fractal\Scope;
use League\Fractal\TransformerAbstract as FractalTransformer;

abstract class Transformer extends FractalTransformer
{
    public function nullableItem($data, $transformer, $resourceKey = null): Primitive|Item
    {
        if (is_null($data)) {
            return $this->primitive(null);
        }

        return $this->item($data, $transformer, $resourceKey = null);
    }

    public function item($data, $transformer, $resourceKey = null): Item
    {
        // set a default resource key if none is set
        if (!$resourceKey && $data) {
            $resourceKey = $data->getResourceKey();
        }

        return parent::item($data, $transformer, $resourceKey);
    }

    public function collection($data, $transformer, $resourceKey = null): Collection
    {
        // set a default resource key if none is set
        if (!$resourceKey && $data->isNotEmpty()) {
            $resourceKey = $data->first()->getResourceKey();
        }

        return parent::collection($data, $transformer, $resourceKey);
    }

    protected function callIncludeMethod(Scope $scope, $includeName, $data)
    {
        try {
            return parent::callIncludeMethod($scope, $includeName, $data);
        } catch (ErrorException $exception) {
            throw new \DomainException();
        } catch (Exception $exception) {
            throw new \DomainException();
        }
    }
}
