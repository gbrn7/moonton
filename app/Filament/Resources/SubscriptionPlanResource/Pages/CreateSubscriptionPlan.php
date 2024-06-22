<?php

namespace App\Filament\Resources\SubscriptionPlanResource\Pages;

use App\Filament\Resources\SubscriptionPlanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateSubscriptionPlan extends CreateRecord
{
    protected static string $resource = SubscriptionPlanResource::class;
}
