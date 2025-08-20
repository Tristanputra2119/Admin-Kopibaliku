<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use App\Nova\User;
class Order extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Order>
     */
    public static $model = \App\Models\Order::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'invoice';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','invoice'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @return array<int, \Laravel\Nova\Fields\Field>
     */
    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),

            Text::make('Invoice')
                ->sortable()
                ->rules('required'),

            BelongsTo::make('Product', 'product', Product::class)
                ->rules('required'),

            BelongsTo::make('Customer', 'customer', Customer::class)
                ->rules('required'),

            // Dropdown satuan
            Select::make('Unit')
                ->options([
                    'g'  => 'Gram',
                    'kg' => 'Kilogram',
                ])
                ->displayUsingLabels()
                ->default('g')
                ->rules('required'),

            Number::make('Quantity')
                ->rules('required', 'numeric', 'min:1'),

            Image::make('Image', 'image')
                ->disk('public')                // simpan di storage/app/public
                ->path('orders')                // folder penyimpanan, misalnya "orders"
                ->creationRules('required')     // wajib isi saat create
                ->updateRules('nullable')       // opsional saat update
                ->storeAs(function (Request $request) {
                    return uniqid() . '.' . $request->image->getClientOriginalExtension();
                }),
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
