<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DadoSaude;
use Carbon\Carbon;

class DadosSaudeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $preencheuHoje = DadoSaude::where('user_id', $user->id)
            ->whereDate('data_registro', Carbon::today())
            ->exists();

        $dados = DadoSaude::where('user_id', $user->id)->orderBy('data_registro', 'desc')->get();

        return view('dados_saude.index', compact('dados', 'preencheuHoje'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $hoje = Carbon::today();
        $jaPreencheuHoje = DadoSaude::where('user_id', $user->id)
            ->whereDate('data_registro', $hoje)
            ->exists();

        if ($jaPreencheuHoje) {
            return back()->with('error', 'Você já preencheu os dados hoje.');
        }

        $validated = $request->validate([
            'endereco' => 'required|string|max:255',
            'idade' => 'required|integer|min:0|max:120',
            'altura' => 'required|numeric|min:0.5|max:3',
            'peso' => 'required|numeric|min:0',
            'circunferencia_abdominal' => 'nullable|integer|min:0',
            'diabetico' => 'nullable|boolean',
            'pressao_alta' => 'nullable|boolean',
            'dores_articulacoes' => 'nullable|boolean',
            'atividade_fisica' => 'nullable|boolean',
        ]);

        $imc = $validated['peso'] / pow($validated['altura'], 2);

        DadoSaude::create([
            'user_id' => $user->id,
            'endereco' => $validated['endereco'],
            'idade' => $validated['idade'],
            'altura' => $validated['altura'],
            'peso' => $validated['peso'],
            'imc' => $imc,
            'circunferencia_abdominal' => $validated['circunferencia_abdominal'] ?? null,
            'diabetico' => $request->has('diabetico'),
            'pressao_alta' => $request->has('pressao_alta'),
            'dores_articulacoes' => $request->has('dores_articulacoes'),
            'atividade_fisica' => $request->has('atividade_fisica'),
            'data_registro' => $hoje,
        ]);

        return back()->with('success', 'Dados salvos com sucesso!');
    }

    public function destroy($id)
    {
        $dado = DadoSaude::findOrFail($id);

        if ($dado->user_id !== Auth::id()) {
            abort(403, 'Acesso não autorizado');
        }

        $dado->delete();
        return back()->with('success', 'Dado removido (mas mantido no histórico).');
    }
}
