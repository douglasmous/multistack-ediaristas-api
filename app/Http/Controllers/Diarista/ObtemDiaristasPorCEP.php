<?php

namespace App\Http\Controllers\Diarista;

use App\Enums\TipoUsuario;
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
        $diarista = User::where('tipo_usuario', '=', TipoUsuario::DIARISTA->value)->get();

        return new DiaristaPublicoCollection($diarista);
    }
}
