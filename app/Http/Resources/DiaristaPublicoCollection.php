<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DiaristaPublicoCollection extends ResourceCollection
{
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
        ];
    }
}
