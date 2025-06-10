<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PizzaType extends Model
{
    protected $fillable = ['slug', 'name', 'category'];

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class, 'ingredient_pizza_types');
    }
}
