<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ingredient extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function pizzTypes(): BelongsToMany
    {
        return $this->belongsToMany(PizzaType::class, 'ingredient_pizza_types');
    }
}
