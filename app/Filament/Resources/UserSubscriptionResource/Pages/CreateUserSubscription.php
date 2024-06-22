<?php

namespace App\Filament\Resources\UserSubscriptionResource\Pages;

use App\Filament\Resources\UserSubscriptionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Role;
use App\Models\User;
use App\Models\UserSubscription;
use Filament\Notifications\Notification;

class CreateUserSubscription extends CreateRecord
{
    protected static string $resource = UserSubscriptionResource::class;

    protected function beforeCreate(): void
    {
        $data = $this->data;

        $userSubscription = UserSubscription::where('user_id', $data['user_id'])
            ->where('expired_date', '>=', now())
            ->get();

        if ($userSubscription) {
            Notification::make()
                ->warning()
                ->title('The user is already have active plan')
                ->send();

            $this->halt();
        }
    }
}
