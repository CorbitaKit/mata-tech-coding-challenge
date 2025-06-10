<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderDetail extends Model
{
    protected $fillable = ['pizza_id', 'slug', 'order_id', 'quantity'];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

}
