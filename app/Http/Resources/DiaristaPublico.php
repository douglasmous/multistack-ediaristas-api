<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin User */
class DiaristaPublico extends JsonResource
{
    /**
     * Define os dados de uma diarista que podem ser retornados publicamente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'nome_completo' => $this->nome_completo,
            'reputacao' => $this->reputacao,
            'foto_usuario' => $this->foto_usuario,
            'cidade' => 'São Paulo',
        ];
    }
}
