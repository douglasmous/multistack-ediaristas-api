<?php

namespace App\Http\Controllers\Endereco;

use App\Http\Requests\CEPRequest;
use App\Services\ConsultaCEP\ConsultaCEPInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;

class BuscaCepApiExterna extends Controller
{
    public function __construct(private readonly ConsultaCEPInterface $servicoCEP)
    {
    }

    /**
     * Retorna os dados de um endereço a partir do CEP.
     *
     * @param  CEPRequest  $request
     * @return JsonResponse
     */
    public function __invoke(CEPRequest $request): JsonResponse
    {
        $dadosEndereco = $this->servicoCEP->buscar($request->cep);

        if ($dadosEndereco === false) {
            throw ValidationException::withMessages(['cep' => 'CEP não encontrado']);
        }

        return response()->json($dadosEndereco, 200);
    }
}
