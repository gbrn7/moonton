<?php

namespace App\Filament\Widgets;

use App\Models\Movie;
use App\Models\User;
use App\Models\UserSubscription;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Users', User::count())
                ->description('User Count'),
            Stat::make('Movies', Movie::count())
                ->description('Movie Count'),
            Stat::make('Revenue This Year', UserSubscription::whereBetween('updated_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
                ->where('payment_status', 'paid')
                ->sum('price'))
                ->description('Paid Transaction This Year'),
        ];
    }
}
