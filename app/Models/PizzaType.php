<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PizzaType extends Model
{
    use HasFactory;
    protected $fillable = ['slug', 'name', 'category'];

    public static function booted(): void
    {
        static::deleting(function (PizzaType $pizzaType) {
           $pizzaType->ingredients()->detach();
        });
    }

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class, 'ingredient_pizza_types');
    }
}
