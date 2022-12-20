<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DiaristaPublicoCollection extends ResourceCollection
{
    public static $wrap = 'diaristas';

    /**
     * Armazena a quantidade de diaristas já enviadas na resposta.
     *
     * @var int
     */
    final const QUANTIDADE_DIARISTAS_DESTAQUE = 6;

    /**
     * Armazena a quantidade total de diaristas menos as já enviadas na resposta.
     *
     * @var int
     */
    private int $quantidadeDiaristas;

    public function __construct($resource, int $quantidadeDiaristas)
    {
        parent::__construct($resource);

        $this->quantidadeDiaristas = $quantidadeDiaristas - self::QUANTIDADE_DIARISTAS_DESTAQUE;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'diaristas' => DiaristaPublico::collection($this->collection),
            'quantidade_diaristas' => $this->quantidadeDiaristas > 0 ? $this->quantidadeDiaristas : 0,
        ];
    }
}
