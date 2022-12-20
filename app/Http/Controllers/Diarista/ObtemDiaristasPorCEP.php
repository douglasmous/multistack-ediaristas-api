<?php

namespace App\Http\Controllers\Diarista;

use App\Actions\Diarista\ObtemDiaristasPorCEP as ObtemDiaristasPorCepAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CEPRequest;
use App\Http\Resources\DiaristaPublicoCollection;
use Illuminate\Http\JsonResponse;

class ObtemDiaristasPorCEP extends Controller
{
    public function __construct(private readonly ObtemDiaristasPorCEPAction $getDiaristasByCEP)
    {
    }

    /**
     * Busca diaristas que atendem determinado CEP.
     *
     * @param  CEPRequest  $request
     * @return DiaristaPublicoCollection|JsonResponse
     */
    public function __invoke(CEPRequest $request): DiaristaPublicoCollection|JsonResponse
    {
        [$diaristasPrincipais, $quantidadeDiaristasRestantes] = $this->getDiaristasByCEP->exec($request->cep);

        return new DiaristaPublicoCollection(
            $diaristasPrincipais,
            $quantidadeDiaristasRestantes
        );
    }
}
