<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\DadoSaude;
use App\Models\DadoUsuario;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nome', 'cpf', 'telefone', 'cargo', 'setor', 'password', 'tipo'
    ];

    protected $hidden = ['password'];

    public function isAdmin()
    {
        return $this->tipo === 'admin';
    }

    public function dadosSaude()
    {
        return $this->hasMany(DadoSaude::class, 'user_id');
    }

    public function dadoUsuario()
    {
        return $this->hasMany(DadoUsuario::class, 'user_id');
    }
}
