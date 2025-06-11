<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

trait Sales
{
    public function getTotalSales(): float
    {
        return DB::table('order_details')
            ->join('pizzas', 'order_details.pizza_id', '=', 'pizzas.id')
            ->selectRaw('SUM(pizzas.price * order_details.quantity) as total')
            ->value('total') ?? 0;
    }

    public function topSellingPizzas(): Collection
    {
        return DB::table('order_details')
        ->join('pizzas', 'order_details.pizza_id', '=', 'pizzas.id')
        ->join('pizza_types', 'pizzas.pizza_type_id', '=', 'pizza_types.id')
        ->select('pizza_types.name', DB::raw('SUM(order_details.quantity) as total_sold'))
        ->groupBy('pizza_types.name')
        ->orderByDesc('total_sold')
        ->take(3)
        ->get();
    }

    public function topSellingIngredients(): Collection
    {
        return DB::table('ingredient_pizza_types')
        ->join('pizzas', 'pizzas.pizza_type_id', '=', 'ingredient_pizza_types.pizza_type_id')
        ->join('order_details', 'order_details.pizza_id', '=', 'pizzas.id')
        ->join('ingredients', 'ingredients.id', '=', 'ingredient_pizza_types.ingredient_id')
        ->select('ingredients.name', DB::raw('SUM(order_details.quantity) as total_used'))
        ->groupBy('ingredients.name')
        ->orderByDesc('total_used')
        ->take(3)
        ->get();

    }

    public function dailySales(): Collection
    {
        return DB::table('orders')
        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
        ->join('pizzas', 'order_details.pizza_id', '=', 'pizzas.id')
        ->selectRaw('DATE(ordered_at) as date, SUM(order_details.quantity * pizzas.price) as total_sales')
        ->groupBy('date')
        ->orderBy('date')
        ->get()
        ->mapWithKeys(function ($item) {
            return [$item->date => $item->total_sales];
        });
    }
    public function weeklySales(): Collection
    {
         return DB::table('orders')
        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
        ->join('pizzas', 'order_details.pizza_id', '=', 'pizzas.id')
        ->selectRaw('YEAR(ordered_at) as year, WEEK(ordered_at, 1) as week, SUM(order_details.quantity * pizzas.price) as total_sales')
        ->groupBy('year', 'week')
        ->orderBy('year')
        ->orderBy('week')
        ->get()
        ->mapWithKeys(function ($item) {
            $week = str_pad($item->week, 2, '0', STR_PAD_LEFT);
            return ["{$item->year}-W{$week}" => $item->total_sales];
        });
    }

    public function monthlySales(): Collection
    {
        return DB::table('orders')
        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
        ->join('pizzas', 'order_details.pizza_id', '=', 'pizzas.id')
        ->selectRaw('YEAR(ordered_at) as year, MONTH(ordered_at) as month, SUM(order_details.quantity * pizzas.price) as total_sales')
        ->groupBy('year', 'month')
        ->orderBy('year')
        ->orderBy('month')
        ->get()
        ->mapWithKeys(function ($item) {
            $month = str_pad($item->month, 2, '0', STR_PAD_LEFT);
            return ["{$item->year}-{$month}" => $item->total_sales];
        });
    }

    public function yearlySales(): Collection
    {
        return  DB::table('orders')
        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
        ->join('pizzas', 'order_details.pizza_id', '=', 'pizzas.id')
        ->selectRaw('YEAR(ordered_at) as year, SUM(order_details.quantity * pizzas.price) as total_sales')
        ->groupBy('year')
        ->orderBy('year')
        ->get()
        ->mapWithKeys(function ($item) {
            return ["{$item->year}" => $item->total_sales];
        });
    }
}
