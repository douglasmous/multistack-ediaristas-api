<?php

namespace App\Http\Controllers\Diarista;

use App\Actions\Diarista\ObtemDiaristasPorCEP as ObtemDiaristasPorCepAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\DiaristaPublicoCollection;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ObtemDiaristasPorCEP extends Controller
{
    /**
     * Busca diraristas que atendem determinado CEP.
     *
     * @param  Request  $request
     * @param  ObtemDiaristasPorCepAction  $action
     * @return DiaristaPublicoCollection|Response
     */
    public function __invoke(Request $request, ObtemDiaristasPorCEPAction $action): DiaristaPublicoCollection|Response
    {
        $request->validate([
            'cep' => 'required|numeric|digits:8',
        ]);
        [$diaristasPrincipais, $quantidadeDiaristasRestantes] = $action->exec($request->cep);

        return new DiaristaPublicoCollection(
            $diaristasPrincipais,
            $quantidadeDiaristasRestantes
        );
    }
}
