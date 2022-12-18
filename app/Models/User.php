<?php

namespace App\Models;

use App\Enums\TipoUsuario;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome_completo',
        'cpf',
        'nascimento',
        'foto_documento',
        'foto_usuario',
        'telefone',
        'email',
        'password',
        'chave_pix',
        'reputacao',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     *  Define a relação com cidades e lista as cidades atendidas.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cidadesAtendidas(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Cidade::class, 'cidade_diarista');
    }

    /**
     * Filtra usuários do tipo diarista
     *
     * @return Builder
     */
    public function scopeDiarista($query): Builder
    {
        return $query->where('tipo_usuario', '=', TipoUsuario::DIARISTA->value);
    }

    /**
     * Filtra usuários do tipo diarista que atendem a cidade informada.
     *
     * @param  int  $codigoCidadeIbge
     * @return Builder
     */
    public function scopeDiaristasAtendemCidade($query, int $codigoCidadeIbge): Builder
    {
        return $query->diarista()
            ->whereHas('cidadesAtendidas', function ($cidadeQuery) use ($codigoCidadeIbge) {
                $cidadeQuery->where('codigo_ibge', '=', $codigoCidadeIbge);
            });
    }

    /**
     * Busca 6 diaristas pelo código da cidade do IBGE
     *
     * @param  int  $codigoCidadeIbge
     * @return Collection
     */
    public static function diaristaDisponivelCidade(int $codigoCidadeIbge): Collection
    {
        return User::diaristasAtendemCidade($codigoCidadeIbge)->limit(6)->get();
    }

    /**
     * Retorna o número de diaristas que atendem uma cidade de acordo com o código da cidade do IBGE
     *
     * @param  int  $codigoCidadeIbge
     * @return int
     */
    public static function diaristaDisponivelCidadeTotal(int $codigoCidadeIbge): int
    {
        return User::diaristasAtendemCidade($codigoCidadeIbge)->count();
    }
}
