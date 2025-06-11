<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    protected $fillable = ['ordered_at', 'slug'];

    public function orderDetail(): HasOne
    {
        return $this->hasOne(OrderDetail::class);
    }
}
