<?php
namespace App\Orchid\Filters\Movies;

use App\Domain\Movies\Repositories\GetElasticMovie;
use Orchid\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Screen\Fields\Input;

class MovieElasticFilter extends Filter
{
    public $parameters = ['search'];

    public function run(Builder $builder): Builder
    {
        $title = $this->request->get('search');
        $ids = app(GetElasticMovie::class)->searchIds($title);

        return $builder->whereIn('id', $ids);
    }

    public function display(): array
    {
        return [
            Input::make('search')
                ->type('text')
                ->value($this->request->get('search'))
                ->placeholder('Search...')
                ->title('Search by elastic')
        ];
    }
}
