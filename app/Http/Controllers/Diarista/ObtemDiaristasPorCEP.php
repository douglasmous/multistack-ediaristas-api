<?php

namespace App\Http\Controllers\Diarista;

use App\Http\Controllers\Controller;
use App\Http\Resources\DiaristaPublicoCollection;
use App\Models\User;
use App\Services\ConsultaCEP\ViaCep;
use Illuminate\Http\Request;

class ObtemDiaristasPorCEP extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Request  $request
     * @return mixed
     */
    public function __invoke(Request $request, ViaCep $servicoCEP)
    {
        $respostaApi = $servicoCEP->buscar($request->cep);

        if ($respostaApi === false) {
            return response()->json(['erro' => 'CEP inválido'], 400);
        }

        return new DiaristaPublicoCollection(
            User::diaristaDisponivelCidade($respostaApi->ibge),
            User::diaristaDisponivelCidadeTotal($respostaApi->ibge)
        );
    }
}
