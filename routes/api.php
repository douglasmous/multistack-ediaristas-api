<?php

use App\Http\Controllers\Diarista\ObtemDiaristasPorCEP;
use App\Http\Controllers\Diarista\VerificaDiaristasDisponiveis;
use App\Http\Controllers\Endereco\BuscaCepApiExterna;
use Illuminate\Support\Facades\Route;

Route::get('/diaristas/localidades', ObtemDiaristasPorCEP::class)->name('diaristas.busca_por_cep');
Route::get('/diaristas/disponibilidade', VerificaDiaristasDisponiveis::class)->name('diaristas.disponibilidade');
Route::get('/enderecos', BuscaCepApiExterna::class)->name('enderecos.cep');
