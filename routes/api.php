<?php

use App\Http\Controllers\Diarista\ObtemDiaristasPorCEP;
use Illuminate\Support\Facades\Route;

Route::get('/diaristas/localidades', ObtemDiaristasPorCEP::class)->name('diaristas.busca_por_cep');
