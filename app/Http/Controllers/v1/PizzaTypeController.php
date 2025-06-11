<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\PizzaType\PizzaTypeRequest;
use App\Services\API\v1\PizzaTypeService;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PizzaTypeController extends Controller
{
    use JsonResponseTrait;

    public function __construct(protected PizzaTypeService $pizzaTypeService){}
    public function store(PizzaTypeRequest $request): JsonResponse
    {
        return $this->handleJsonReponse(
            fn() => $this->pizzaTypeService->create($request->validated()),
            'Pizza Type Created',
            201
        );
    }

    public function update(Request $request, int $id): JsonResponse
    {
        return $this->handleJsonReponse(
            fn() => $this->pizzaTypeService->update($request->all(), $id),
            'Pizza Type Updated',
            200
        );
    }

    public function destroy(int $id): JsonResponse
    {
        return $this->handleJsonReponse(
            fn() => $this->pizzaTypeService->delete($id),
            'Pizza Type Deleted',
            200
        );
    }
}
