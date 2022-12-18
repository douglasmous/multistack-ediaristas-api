<?php

namespace App\Services\ConsultaCEP;

use Illuminate\Support\Facades\Http;

class ViaCep
{
    /**
     * Recebe o CEP, busca o endereço na api do ViaCEP e retorna o código IBGE do município.
     *
     * @param  string  $cep
     * @return false|EnderecoResponse
     */
    public function buscar(string $cep): false|EnderecoResponse
    {
        $resposta = Http::get("https://viacep.com.br/ws/$cep/json");

        if ($resposta->failed()) {
            return false;
        }

        $dados = $resposta->json();

        if (isset($dados['erro']) && $dados['erro'] === true) {
            return false;
        }

        return new EnderecoResponse(ibge: $dados['ibge']);
    }
}
