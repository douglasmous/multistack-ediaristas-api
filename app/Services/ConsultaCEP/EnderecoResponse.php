<?php

namespace App\Services\ConsultaCEP;

class EnderecoResponse
{
    public function __construct(public readonly string $ibge, public readonly string $localidade, public readonly string $cep, public readonly string $logradouro, public readonly string $bairro, public readonly string $uf)
    {
    }
}
