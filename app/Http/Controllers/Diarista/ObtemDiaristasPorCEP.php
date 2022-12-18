<?php

namespace App\Http\Controllers\Diarista;

use App\Http\Controllers\Controller;
use App\Http\Resources\DiaristaPublicoCollection;
use App\Models\User;
use Illuminate\Http\Request;

class ObtemDiaristasPorCEP extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Request  $request
     * @return DiaristaPublicoCollection
     */
    public function __invoke(Request $request)
    {
        $diaristas = User::diarista()->get();

        return new DiaristaPublicoCollection($diaristas);
    }
}
