<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\TotalCategory;
use App\Nova\Metrics\TotalCustomers;
use App\Nova\Metrics\TotalOrders;
use App\Nova\Metrics\TotalProduct;
use App\Nova\Metrics\TotalRevenue;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Dashboards\Main as Dashboard;

class Main extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array<int, \Laravel\Nova\Card>
     */
    public function cards(): array
    {
        return [
            new TotalProduct,
            new TotalCategory(),
            new TotalCustomers(),
            new TotalOrders(),
            new TotalRevenue(),
//            new MonthlySales,
        ];
    }
}
