<?php

namespace App\Actions\Diarista;

use App\Models\User;
use App\Services\ConsultaCEP\ConsultaCEPInterface;
use Illuminate\Validation\ValidationException;

class ObtemDiaristasPorCEP
{
    public function __construct(private readonly ConsultaCEPInterface $servicoCEP)
    {
    }

    /**
     * Retorna os diaristas disponíveis na cidade através do CEP.
     *
     * @param  string  $cep
     * @return array
     */
    public function exec(string $cep): array
    {
        $respostaApi = $this->servicoCEP->buscar($cep);

        if ($respostaApi === false) {
            throw ValidationException::withMessages(['cep' => 'CEP não encontrado']);
        }

        return [
            User::diaristaDisponivelCidade($respostaApi->ibge),
            User::diaristaDisponivelCidadeTotal($respostaApi->ibge),
        ];
    }
}
