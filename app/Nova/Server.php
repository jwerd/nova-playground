<?php

namespace App\Nova;

use App\Nova\Metrics\Heartbeat;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Spatie\TagsField\Tags;
use Signifly\Nova\Fields\ProgressBar\ProgressBar;

class Server extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Server::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'title'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make('Title', 'title')
                ->sortable()
                ->rules('required', 'max:255'),
            BelongsTo::make('Game'),
            ProgressBar::make('Capacity')->hideWhenCreating()->hideWhenUpdating(),
            Number::make('Current Players', 'current_player_count')->hideFromIndex(),
            Number::make('Max Players', 'max_player_count')->hideFromIndex(),
            //$this->last_queried->diffForHumans(),
            Text::make('Last queried', function () {
                return $this->last_queried->diffForHumans();
            }),
            //DateTime::make( 'Last queried', 'last_queried')->diffForHumans(),
            Tags::make('Tags')->hideFromIndex(),
            HasMany::make('Attributes')->hideFromIndex(),
            HasMany::make('Comments')->hideFromIndex(),
//            HasMany::make('Heartbeat')->hideFromIndex(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [
            (new Heartbeat())->onlyOnDetail()->width('full')
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new Filters\GameType('id')
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [
            new Lenses\MostPopulatedServers,
        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
