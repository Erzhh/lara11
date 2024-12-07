<?php
namespace App\Orchid\Filters\Movies;

use Orchid\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Screen\Fields\Input;

class MovieTitleFilter extends Filter
{
    public $parameters = ['title'];

    public function run(Builder $builder): Builder
    {
        $title = $this->request->get('title');

        return $builder
                ->where('movie', 'ilike' , "%{$title}%")
                ->orWhere('overview', 'ilike', "%{$title}%");
    }

    public function display(): array
    {
        return [
            Input::make('title')
                ->type('text')
                ->value($this->request->get('title'))
                ->placeholder('Search...')
                ->title('Search by db')
        ];
    }
}
