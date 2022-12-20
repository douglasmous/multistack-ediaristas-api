<?php

namespace App\Http\Controllers\Diarista;

use App\Http\Controllers\Controller;
use App\Http\Resources\DiaristaPublicoCollection;
use App\Models\User;
use App\Services\ConsultaCEP\ConsultaCEPInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
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
        $request->validate([
            'cep' => 'required|numeric|digits:8',
        ]);

        $respostaApi = $servicoCEP->buscar($request->cep);

        if ($respostaApi === false) {
            throw ValidationException::withMessages(['cep' => 'CEP não encontrado']);
        }

        return new DiaristaPublicoCollection(
            User::diaristaDisponivelCidade($respostaApi->ibge),
            User::diaristaDisponivelCidadeTotal($respostaApi->ibge),
        );
    }
}
