<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ingredient extends Model
{
    protected $fillable = ['name'];

    public function pizzTypes(): BelongsToMany
    {
        return $this->belongsToMany(PizzaType::class, 'ingredient_pizza_types');
    }
}
