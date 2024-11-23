<?php

namespace API\Advert\Controllers;

use App\Domain\Advert\Models\Advert;
use Core\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdvertController extends BaseController
{
    public function store(Request $request): JsonResponse
    {
        $data = $request->all();

        $advert = new Advert();
        $advert->fill($data);
        $advert->save();

        return response()->json(['advert' => $advert], 201);
    }

    public function update(Request $request): JsonResponse
    {
        $id = $request->id;
        $data = $request->all();

        $advert = Advert::query()->findOrFail($id);
        $advert->fill($data);
        $advert->save();

        return response()->json(['advert' => $advert], 200);
    }

    public function list(Request $request): JsonResponse
    {
        $records = Advert::query()->get();

        return response()->json(['advert' => $records]);
    }


    public function findById(Request $request): JsonResponse
    {
        $id = $request->id;
        $record = Advert::query()->where('id', $id)->first();

        return response()->json(['advert' => $record]);
    }

    public function deleteById(Request $request): JsonResponse
    {
        $id = $request->id;
        Advert::query()->where('id', $id)->delete();

        return response()->json(['msg' => 'success delete'],204);
    }
}
