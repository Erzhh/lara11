<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Adverts;

use App\Domain\Advert\Models\Advert;
use Orchid\Screen\Fields\Map;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class ListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'records' => Advert::query()->paginate()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Get Started';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Welcome to your Orchid application.';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('records', [
                TD::make('title'),
                TD::make('location')->render(function ($value) {
                    return Map::make('location')->value([
                        'lat' => $value->location['lat'],
                        'lng' => $value->location['lon']
                    ])->render();
                }),
            ])
        ];
    }
}
