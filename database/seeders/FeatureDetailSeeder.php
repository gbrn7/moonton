<?php

namespace Database\Seeders;

use App\Models\featureDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        featureDetail::insert([
            [
                'subscription_plan_id' => 1,
                'name' => 'feature-1'
            ],
            [
                'subscription_plan_id' => 1,
                'name' => 'feature-2'
            ],
            [
                'subscription_plan_id' => 1,
                'name' => 'feature-3'
            ],
            [
                'subscription_plan_id' => 2,
                'name' => 'feature-1'
            ],
            [
                'subscription_plan_id' => 2,
                'name' => 'feature-2'
            ],
            [
                'subscription_plan_id' => 2,
                'name' => 'feature-3'
            ],
            [
                'subscription_plan_id' => 2,
                'name' => 'feature-4'
            ],
        ]);
    }
}
