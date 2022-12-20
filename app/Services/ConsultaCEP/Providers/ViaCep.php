<?php

namespace App\Services\ConsultaCEP\Providers;

use App\Services\ConsultaCEP\ConsultaCEPInterface;
use App\Services\ConsultaCEP\EnderecoResponse;
use Illuminate\Support\Facades\Http;

class ViaCep implements ConsultaCEPInterface
{
    /**
     * Recebe o CEP, busca o endereço na api do ViaCEP e retorna o código IBGE do município.
     *
     * @param  string  $cep
     * @return false|EnderecoResponse
     */
    public function buscar(string $cep = ''): false|EnderecoResponse
    {
        $resposta = Http::get("https://viacep.com.br/ws/$cep/json");

        if ($resposta->failed()) {
            return false;
        }

        $dados = $resposta->json();

        if (isset($dados['erro']) && $dados['erro'] === true) {
            return false;
        }

        return new EnderecoResponse(cep: $dados['cep'], logradouro: $dados['logradouro'], bairro: $dados['bairro'], localidade: $dados['localidade'], uf: $dados['uf'], ibge: $dados['ibge']);
    }
}
