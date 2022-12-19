<?php

namespace App\Http\Controllers\Diarista;

use App\Http\Controllers\Controller;
use App\Http\Resources\DiaristaPublicoCollection;
use App\Models\User;
use App\Services\ConsultaCEP\ConsultaCEPInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ObtemDiaristasPorCEP extends Controller
{
    /**
     *  Busca diaristas pelo CEP.
     *
     * @param  Request  $request
     * @param  ConsultaCEPInterface  $servicoCEP
     * @return DiaristaPublicoCollection|Response
     */
    public function __invoke(Request $request, ConsultaCEPInterface $servicoCEP): DiaristaPublicoCollection|Response
    {
        $respostaApi = $servicoCEP->buscar($request->cep ?? '');

        if ($respostaApi === false) {
            return response()->json(['erro' => 'CEP inválido'], 400);
        }

        return new DiaristaPublicoCollection(
            User::diaristaDisponivelCidade($respostaApi->ibge),
            User::diaristaDisponivelCidadeTotal($respostaApi->ibge),
        );
    }
}
