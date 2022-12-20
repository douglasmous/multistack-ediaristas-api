<?php

namespace App\Http\Controllers\Diarista;

use App\Actions\Diarista\ObtemDiaristasPorCEP;
use App\Http\Controllers\Controller;
use App\Http\Requests\CEPRequest;
use Illuminate\Http\JsonResponse;

class VerificaDiaristasDisponiveis extends Controller
{
    public function __construct(private readonly ObtemDiaristasPorCEP $getDiaristasByCEP)
    {
    }

    public function __invoke(CEPRequest $request): JsonResponse
    {
        [$diaristasCollection] = $this->getDiaristasByCEP->exec($request->cep);

        return api_response(
            statusCode: 200,
            message: 'Disponibilidade verificada com sucesso',
            code: 'Success',
            description: ['disponibilidade' => $diaristasCollection->isNotEmpty()],
        );
    }
}
