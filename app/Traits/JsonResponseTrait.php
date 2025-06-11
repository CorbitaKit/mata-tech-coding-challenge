<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use InvalidArgumentException;
use Throwable;

trait JsonResponseTrait
{
    protected function handleJsonReponse(
        callable $callback,
        string $successMessage = 'Success',
        int $successCode = 200
    ): JsonResponse
    {
        try {
            $data = $callback();

            return response()->json([
                'message' => $successMessage,
                'data' => $data
            ], $successCode);
        } catch (InvalidArgumentException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 422);

        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Server error.',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }
}
