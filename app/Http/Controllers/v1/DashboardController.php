<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Services\API\v1\IngredientService;
use App\Services\API\v1\OrderDetailService;
use App\Services\API\v1\OrderService;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    use JsonResponseTrait;

    public function __construct(
        protected OrderService $orderService,
        protected OrderDetailService $orderDetailService,
        protected IngredientService $ingredientService
    ){}

    public function totalSales(): JsonResponse
    {
        return $this->handleJsonReponse(
            fn() => Cache::remember('dashboard_total_sales', now()->addMinutes(10), function () {
                return $this->orderDetailService->getTotalSales();
            }),
            'Total Sales',
            200
        );
    }

    public function totalOrders(): JsonResponse
    {
        return $this->handleJsonReponse(
            fn() => Cache::remember('dashboard_total_orders', now()->addMinutes(10), function () {
                return $this->orderService->total();
            }),
            'Total Order',
            200
        );
    }

    public function topSellingPizzas(): JsonResponse
    {
        return $this->handleJsonReponse(
            fn() => Cache::remember('dashboard_top_selling_pizzas', now()->addMinutes(10), function () {
                return $this->orderDetailService->topSellingPizzas();
            }),
            'Top Selling Pizzas',
            200
        );
    }

    public function topsSellingIngredients(): JsonResponse
    {
        return $this->handleJsonReponse(
            fn() => Cache::remember('dashboard_top_selling_ingredients', now()->addMinutes(10), function () {
                return $this->ingredientService->topSellingIngredients();
            }),
            'Top Selling Ingredients',
            200
        );
    }

    public function salesSummary(Request $request): JsonResponse
    {


        return $this->handleJsonReponse(
            fn() => Cache::remember('sales-summary', now()->addMinutes(10), function () {
                return $this->orderService->getSalesSummary();
            }),
            'Sale Summary',
            200
        );
    }

    public function getLatestOrders(): JsonResponse
    {
        return $this->handleJsonReponse(
            fn() => Cache::remember('dashboard_latest_orders', now()->addMinutes(5), function () {
                return $this->orderService->getLatestOrders();
            }),
            'Latest Orders',
            200
        );
    }
}
