<?php

use Illuminate\Http\JsonResponse;

if (! function_exists('error_response')) {
    /**
     * Retorna uma resposta padronizada quando ocorre algum erros
     *
     * @param  string  $message
     * @param  string  $errorCode
     * @param  int  $statusCode
     * @param  array  $errorDescription
     * @return JsonResponse
     */
    function error_response(
    string $message,
    string $errorCode,
    int $statusCode,
    array $errorDescription = []
  ): JsonResponse {
        return response()->json([
            'message' => $message,
            'error_code' => $errorCode,
            'status_code' => $statusCode,
            'error_description' => [...$errorDescription],
        ], $statusCode);
    }
}
