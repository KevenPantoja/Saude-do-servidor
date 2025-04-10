<?php

namespace App\Http\Controllers;

use App\Models\DadoUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DadoUsuarioController extends Controller
{
    public function form()
    {
        return view('cliente.dados_adicionais');
    }

    public function salvar(Request $request)
    {
        $user = Auth::user();

        $jaEditouHoje = DadoUsuario::where('user_id', $user->id)
            ->whereDate('created_at', Carbon::today())
            ->exists();

        if ($jaEditouHoje) {
            return back()->with('erro', 'Você só pode atualizar seus dados uma vez por dia.');
        }

        $dados = $request->validate([
            'ocupacao' => 'nullable|string|max:100',
            'renda_mensal' => 'nullable|numeric|min:0',
            'informacoes_complementares' => 'nullable|string|max:1000',
            // outros campos adicionais se existirem...
        ]);

        $dados['user_id'] = $user->id;
        DadoUsuario::create($dados);

        return back()->with('sucesso', 'Dados salvos com sucesso!');
    }

    public function dashboard()
{
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login')->with('error', 'Você precisa estar logado para acessar o painel.');
    }

    $ultimoDado = $user->dadosSaude()->latest('data_registro')->first();

    return view('cliente.dashboard', compact('user', 'ultimoDado'));
}


}
