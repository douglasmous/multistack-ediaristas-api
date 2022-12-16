<?php

namespace App\Http\Controllers\Diarista;

use App\Http\Controllers\Controller;
use App\Http\Resources\DiaristaPublico;
use App\Models\User;
use Illuminate\Http\Request;

class ObtemDiaristasPorCEP extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return DiaristaPublico
     */
    public function __invoke(Request $request)
    {
        $diarista = User::where('tipo_usuario', '=', 2)->first();

        return new DiaristaPublico($diarista);
    }
}
