<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Http\Requests\NovaRequest;

class Kopi extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Kopi>
     */
    public static $model = \App\Models\Kopi::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'nama_kopi';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'nama_kopi', 'jenis_kopi',
    ];

    /**
     * Label to show in sidebar.
     */
    public static function label(): string
    {
        return 'Kopi';
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @return array<int, \Laravel\Nova\Fields\Field>
     */
    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),

            Text::make('Nama Kopi')
                ->rules('required', 'max:255')
                ->sortable(),

            Text::make('Jenis Kopi')
                ->rules('required', 'max:255'),

            Number::make('Stok')
                ->rules('required', 'min:0'),

            Number::make('Harga')
                ->rules('required', 'min:0'),

            Textarea::make('Deskripsi')
                ->alwaysShow(),

            Image::make('Gambar')
                ->disk('public')
                ->path('gambar_kopi')
                ->preview(function () {
                    return $this->gambar ? asset('storage/' . $this->gambar) : null;
                })
                ->thumbnail(function () {
                    return $this->gambar ? asset('storage/' . $this->gambar) : null;
                })
                ->rules('nullable', 'image', 'max:2048'),

            DateTime::make('Created At')->onlyOnDetail(),
            DateTime::make('Updated At')->onlyOnDetail(),
        ];
    }

    /**
     * Get the cards available for the resource.
     *
     * @return array<int, \Laravel\Nova\Card>
     */
    public function cards(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array<int, \Laravel\Nova\Filters\Filter>
     */
    public function filters(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @return array<int, \Laravel\Nova\Lenses\Lens>
     */
    public function lenses(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @return array<int, \Laravel\Nova\Actions\Action>
     */
    public function actions(NovaRequest $request): array
    {
        return [];
    }
}
