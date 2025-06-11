<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pizza extends Model
{
    protected $fillable = ['slug', 'pizza_type_id', 'size', 'price'];

    public function pizzaType(): BelongsTo
    {
        return $this->belongsTo(PizzaType::class);
    }
}
