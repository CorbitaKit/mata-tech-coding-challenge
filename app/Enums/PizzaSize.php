<?php
namespace App\Enums;
enum PizzaSize: string
{
    case SMALL = 'S';
    case MEDIUM = 'M';
    case LARGE = 'L';
    case EXTRA_LARGE = 'XL';

    case EXTRA_EXTRA_LARGE = 'XXL';
}
