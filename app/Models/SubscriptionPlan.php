<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionPlan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'active_period_in_months',
    ];

    /**
     * Get all of the featureDetail for the featureDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function featureDetail(): HasMany
    {
        return $this->hasMany(featureDetail::class, 'subscription_plan_id', 'id');
    }
}
