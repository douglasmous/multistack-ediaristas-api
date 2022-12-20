<?php

namespace App\Exceptions;

use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;

trait ApiHandler
{
    /**
     * Handler de exceções da API.
     *
     * @param  \Throwable  $e
     * @return JsonResponse
     */
    protected function getJsonException(\Throwable $e): JsonResponse
    {
        if ($e instanceof ValidationException) {
            return $this->validationException($e);
        }

        return $this->genericException();
    }

    /**
     * Retorna uma resposta para casos de exceções de validação de dados enviados pelo cliente.
     *
     * @param  ValidationException  $e
     * @return JsonResponse
     */
    private function validationException(ValidationException $e): JsonResponse
    {
        return error_response(statusCode: 400, errorCode: 'validation_exception', message: 'Os dados enviados não são válidos', errorDescription: $e->errors());
    }

    /**
     *  Retorna uma resposta para casos de exceções no servidor.
     *
     * @return JsonResponse
     */
    private function genericException(): JsonResponse
    {
        return error_response(statusCode: 500, errorCode: 'internal_error', message: 'Erro interno do servidor');
    }
}
