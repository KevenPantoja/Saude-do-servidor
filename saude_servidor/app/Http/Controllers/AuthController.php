<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    use Illuminate\Support\Facades\Auth;

    public function login(Request $request)
    {
        // Validação dos dados do formulário
        $credentials = $request->only('cpf', 'password');

        if (Auth::attempt($credentials)) {
            // Se o usuário for autenticado, verifica se é admin
            $user = Auth::user();

            if ($user->is_admin) {
                // Se for admin, redireciona para o painel administrativo
                return redirect()->route('admin.dashboard');
            } else {
                // Caso contrário, redireciona para a página normal
                return redirect()->route('user.dashboard');
            }
        }

        // Caso as credenciais estejam erradas, retorna para o login com erro
        return redirect()->back()->withErrors([
            'cpf' => 'As credenciais informadas estão incorretas.',
        ]);
    }


    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|unique:users',
            'telefone' => 'required|string|max:20',
            'cargo' => 'required|string|max:100',
            'setor' => 'required|string|max:100',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'telefone' => $request->telefone,
            'cargo' => $request->cargo,
            'setor' => $request->setor,
            'password' => Hash::make($request->password),
            'admin' => false,
        ]);

        Auth::login($user);
        return redirect()->route('cliente.dados.adicionais');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    use Illuminate\Support\Facades\Auth;

    protected function authenticated(Request $request, $user)
    {
        // Redireciona para o painel do admin se o usuário for admin
        if ($user->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        // Caso contrário, redireciona para a dashboard do usuário
        return redirect()->route('user.dashboard');
    }

}
