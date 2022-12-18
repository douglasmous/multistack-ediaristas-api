<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DiaristaPublicoCollection extends ResourceCollection
{
    final const QUANTIDADE_DIARISTAS_DESTAQUE = 6;

    private int $quantidadeDiaristas;

    public function __construct($resource, int $quantidadeDiaristas)
    {
        parent::__construct($resource);

        $this->quantidadeDiaristas = $quantidadeDiaristas - self::QUANTIDADE_DIARISTAS_DESTAQUE;
    }

    public static $wrap = 'diaristas';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return AnonymousResourceCollection[]
     */
    public function toArray($request)
    {
        return [
            'diaristas' => DiaristaPublico::collection($this->collection),
            'quantidade_diaristas' => $this->quantidadeDiaristas > 0 ? $this->quantidadeDiaristas : 0,
        ];
    }
}
