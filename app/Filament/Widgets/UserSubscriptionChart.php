<?php

namespace App\Filament\Widgets;

use App\Models\UserSubscription;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class UserSubscriptionChart extends ChartWidget
{
    protected static ?string $heading = 'Paid Transaction Chart';

    protected int | string | array $columnSpan = 'full';

    protected static ?string $maxHeight = '300px';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = Trend::query(UserSubscription::where('payment_status', 'paid')->whereBetween('updated_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()]))
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perDay()
            ->sum('price');

        return [
            'datasets' => [
                [
                    'label' => 'Transaction this year',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
