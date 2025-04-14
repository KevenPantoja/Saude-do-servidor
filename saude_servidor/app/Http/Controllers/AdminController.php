<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DadoSaude;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function dashboard()
    {
        $usuarios = User::all();
        $totalUsuarios = User::count();
        $totalRegistros = DadoSaude::count();
        return view('admin.dashboard', compact('usuarios', 'totalUsuarios', 'totalRegistros'));
    }

    public function index()
    {
        return redirect()->route('admin.dashboard');
    }

    public function verDados(User $user)
    {
        $dados = $user->dadosSaude()->orderBy('data_registro', 'desc')->get();
        return view('admin.ver_dados', ['usuario' => $user, 'dados' => $dados]);
    }

    public function excluirDado($id)
    {
        $dado = DadoSaude::findOrFail($id);
        $dado->delete();
        return back()->with('sucesso', 'Registro excluído com sucesso!');
    }

    public function criarUsuario()
    {
        return view('admin.criar_usuario');
    }

    public function salvarUsuario(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'cpf' => 'required|string|unique:users',
            'telefone' => 'nullable|string',
            'cargo' => 'nullable|string',
            'setor' => 'nullable|string',
            'is_admin' => 'nullable|boolean',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->cpf = $request->cpf;
        $user->telefone = $request->telefone;
        $user->cargo = $request->cargo;
        $user->setor = $request->setor;
        $user->is_admin = $request->has('is_admin') ? true : false;
        $user->password = Hash::make('senha123'); // senha padrão
        $user->save();

        return redirect()->route('admin.dashboard')->with('sucesso', 'Usuário criado com sucesso!');
    }

    public function editarUsuario($id)
    {
        $usuario = User::findOrFail($id);
        return view('admin.editar_usuarios', compact('usuario'));
    }

    public function atualizarUsuario(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->name = $request->name;
        $usuario->telefone = $request->telefone;
        $usuario->cargo = $request->cargo;
        $usuario->setor = $request->setor;
        $usuario->is_admin = $request->has('is_admin');
        $usuario->save();

        return redirect()->route('admin.dashboard')->with('sucesso', 'Usuário atualizado com sucesso!');
    }

    public function excluirUsuario($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();
        return redirect()->route('admin.dashboard')->with('sucesso', 'Usuário excluído com sucesso!');
    }
}
