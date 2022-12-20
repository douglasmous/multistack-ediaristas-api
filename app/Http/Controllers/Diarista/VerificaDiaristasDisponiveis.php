<?php

namespace App\Http\Controllers\Diarista;

use App\Actions\Diarista\ObtemDiaristasPorCEP;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VerificaDiaristasDisponiveis extends Controller
{
    public function __construct(private readonly ObtemDiaristasPorCEP $getDiaristasByCEP)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $request->validate([
            'cep' => 'required|numeric|digits:8',
        ]);

        [$diaristasCollection] = $this->getDiaristasByCEP->exec($request->cep);

        return api_response(
            statusCode: 200,
            message: 'Disponibilidade verificada com sucesso',
            code: 'Success',
            description: ['disponibilidade' => $diaristasCollection->isNotEmpty()],
        );
    }
}
