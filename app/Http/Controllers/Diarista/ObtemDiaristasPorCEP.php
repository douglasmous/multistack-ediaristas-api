<?php

namespace App\Http\Controllers\Diarista;

use App\Actions\Diarista\ObtemDiaristasPorCEP as ObtemDiaristasPorCepAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\DiaristaPublicoCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ObtemDiaristasPorCEP extends Controller
{
    public function __construct(private readonly ObtemDiaristasPorCEPAction $getDiaristasByCEP)
    {
    }

    /**
     * Busca diaristas que atendem determinado CEP.
     *
     * @param  Request  $request
     * @return DiaristaPublicoCollection|JsonResponse
     */
    public function __invoke(Request $request): DiaristaPublicoCollection|JsonResponse
    {
        $request->validate([
            'cep' => 'required|numeric|digits:8',
        ]);
        [$diaristasPrincipais, $quantidadeDiaristasRestantes] = $this->getDiaristasByCEP->exec($request->cep);

        return new DiaristaPublicoCollection(
            $diaristasPrincipais,
            $quantidadeDiaristasRestantes
        );
    }
}
