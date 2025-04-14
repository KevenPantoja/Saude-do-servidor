<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DadosSaudeController;
use App\Http\Controllers\DadoUsuarioController;

/*
|--------------------------------------------------------------------------
| Autenticação e Registro
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
| Rotas para usuários comuns
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
| Rotas para administradores
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    

    Route::get('/dados/{user}', [AdminController::class, 'verDados'])->name('ver.dados');
    Route::delete('/dados/{id}', [AdminController::class, 'excluirDado'])->name('excluir.dado');

    // Gerenciamento de usuários
    Route::get('/usuarios/criar', [AdminController::class, 'criarUsuario'])->name('usuarios.criar');
    Route::post('/usuarios/salvar', [AdminController::class, 'salvarUsuario'])->name('usuarios.salvar');
    Route::get('/usuarios/{id}/editar', [AdminController::class, 'editarUsuario'])->name('usuarios.editar');
    Route::put('/usuarios/{id}/atualizar', [AdminController::class, 'atualizarUsuario'])->name('usuarios.atualizar');
    Route::delete('/usuarios/{id}/excluir', [AdminController::class, 'excluirUsuario'])->name('usuarios.excluir');
});
