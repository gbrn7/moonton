<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class featureDetail extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'subscription_plan_id'];
}
