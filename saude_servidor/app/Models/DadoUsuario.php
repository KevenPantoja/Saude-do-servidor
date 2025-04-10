<?php

// app/Models/DadoUsuario.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DadoUsuario extends Model
{
    protected $fillable = [
        'user_id', 'endereco', 'idade', 'altura', 'data_registro',
        'peso', 'imc', 'circunferencia_abdominal',
        'diabetico', 'pressao_alta', 'dores_articulacoes', 'atividade_fisica'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
