<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Movies;

use App\Domain\Movies\Models\Movie;
use App\Orchid\Filters\Movies\MovieSelection;
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
            'records' => Movie::query()
                            ->filters(MovieSelection::class)
                            ->paginate()
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
            MovieSelection::class,
            Layout::table('records',[
                TD::make('id'),
                TD::make('photo')->render(function ($value) {
                    return "<img src='{$value->url_logo}' alt='{$value->url_logo}' style='width: 100px;'>";
                }),
                TD::make('movie'),
                TD::make('overview')
            ])
        ];
    }
}
