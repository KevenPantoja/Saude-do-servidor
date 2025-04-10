<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DadoUsuarioController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DadosSaudeController;

/*
|--------------------------------------------------------------------------
| Rotas Públicas (Login, Registro)
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

/*
|--------------------------------------------------------------------------  
| Rotas de Usuários Logados (Cliente)
|--------------------------------------------------------------------------  
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DadoUsuarioController::class, 'dashboard'])->name('dashboard');

    Route::get('/cliente/dados', [DadoUsuarioController::class, 'form'])->name('cliente.dados.adicionais');
    Route::post('/cliente/dados/salvar', [DadoUsuarioController::class, 'salvar'])->name('cliente.dados.salvar');

    Route::get('/dados-saude', [DadosSaudeController::class, 'index'])->name('dados.index');
    Route::post('/dados-saude', [DadosSaudeController::class, 'store'])->name('dados.store');
    Route::delete('/dados-saude/{id}', [DadosSaudeController::class, 'destroy'])->name('dados.destroy');
});

/*
|--------------------------------------------------------------------------
| Rotas Exclusivas de Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/dados/{user}', [AdminController::class, 'verDados'])->name('ver.dados');
    Route::delete('/dados/{id}', [AdminController::class, 'excluirDado'])->name('excluir.dado');
    Route::delete('/delete/{id}', [AdminController::class, 'deleteDados'])->name('delete');
    Route::get('/admin/gestao-usuarios', [AdminController::class, 'gestaoUsuarios'])->name('gestao.usuarios');
    Route::post('/admin/usuarios', [AdminController::class, 'criarUsuario'])->name('admin.criar.usuario');
    Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/dados/{user}', [AdminController::class, 'verDados'])->name('ver.dados');
        Route::delete('/dados/{id}', [AdminController::class, 'excluirDado'])->name('excluir.dado');
    
        // CRUD de usuários
        Route::get('/usuarios/criar', [AdminController::class, 'criarUsuario'])->name('usuarios.criar');
        Route::post('/usuarios/salvar', [AdminController::class, 'salvarUsuario'])->name('usuarios.salvar');
        Route::get('/usuarios/{id}/editar', [AdminController::class, 'editarUsuario'])->name('usuarios.editar');
        Route::put('/usuarios/{id}/atualizar', [AdminController::class, 'atualizarUsuario'])->name('usuarios.atualizar');
        Route::delete('/usuarios/{id}/excluir', [AdminController::class, 'excluirUsuario'])->name('usuarios.excluir');
    });
    

});

// Teste admin
Route::get('/admin/teste', function () {
    return 'Você é um administrador!';
})->middleware(['auth', 'is_admin']);
Route::get('/dashboard-admin', [AdminController::class, 'index'])->name('dashboard.admin');
Route::get('/dashboard-usuario', [DadosSaudeController::class, 'index'])->name('dashboard.usuario');
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
});
