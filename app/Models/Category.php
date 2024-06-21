<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description'];

    /**
     * Get all of the Movies for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Movies(): HasMany
    {
        return $this->hasMany(Movie::class, 'category_id', 'id');
    }
}
