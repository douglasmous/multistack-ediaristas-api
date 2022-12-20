<?php

use Illuminate\Http\JsonResponse;

if (! function_exists('api_response')) {
    /**
     * Padroniza as respostas da API.
     *
     * @param  string  $message
     * @param  string  $code
     * @param  int  $statusCode
     * @param  array  $description
     * @return JsonResponse
     */
    function api_response(
        string $message,
        string $code,
        int $statusCode,
        array $description = []
    ): JsonResponse {
        return response()->json([
            'message' => $message,
            'code' => $code,
            'status_code' => $statusCode,
            'description' => [...$description],
        ], $statusCode);
    }
}
