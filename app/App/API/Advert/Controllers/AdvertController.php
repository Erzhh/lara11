<?php
declare(strict_types=1);
namespace API\Advert\Controllers;

use API\Advert\Requests\AdvertCreateRequest;
use App\Domain\Advert\Models\Advert;
use Core\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdvertController extends BaseController
{
    /**
     * @param  AdvertCreateRequest $request
     * @return JsonResponse
     */
    public function store(AdvertCreateRequest $request): JsonResponse
    {
        $data = $request->getData();

        $advert = new Advert();
        $advert->fill($data);
        $advert->save();

        return response()->json(['advert' => $advert], 201);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $id = $request->id;
        $data = $request->all();

        $advert = Advert::query()->findOrFail($id);
        $advert->fill($data);
        $advert->save();

        return response()->json(['advert' => $advert], 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        $records = Advert::query()->get();

        return response()->json(['advert' => $records]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function findById(Request $request): JsonResponse
    {
        $id = $request->id;
        $record = Advert::query()->where('id', $id)->first();

        return response()->json(['advert' => $record]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteById(Request $request): JsonResponse
    {
        $id = $request->id;
        Advert::query()->where('id', $id)->delete();

        return response()->json(['msg' => 'success delete'],204);
    }
}
