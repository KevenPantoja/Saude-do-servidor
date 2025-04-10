<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DadoSaude extends Model
{
    use SoftDeletes;

    protected $table = 'dados_saude';

    protected $fillable = [
        'user_id',
        'endereco',
        'idade',
        'altura',
        'peso',
        'imc',
        'circunferencia_abdominal',
        'diabetico',
        'pressao_alta',
        'dores_articulacoes',
        'atividade_fisica',
        'data_registro',
    ];

    protected $casts = [
        'diabetico' => 'boolean',
        'pressao_alta' => 'boolean',
        'dores_articulacoes' => 'boolean',
        'atividade_fisica' => 'boolean',
        'data_registro' => 'date',
    ];
}
