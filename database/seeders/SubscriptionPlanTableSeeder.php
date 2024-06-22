<?php

namespace Database\Seeders;

use App\Models\SubscriptionPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionPlanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subscriptionPlan = [
            [
                'name' => 'Basic',
                'price' => 200000,
                'active_period_in_months' => 3,
            ],
            [
                'name' => 'Premium',
                'price' => 800000,
                'active_period_in_months' => 6,
            ]
        ];

        SubscriptionPlan::insert($subscriptionPlan);
    }
}
