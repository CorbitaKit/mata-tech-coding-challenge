<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    protected $fillable = ['slug', 'pizza_type_id', 'size', 'price'];
}
