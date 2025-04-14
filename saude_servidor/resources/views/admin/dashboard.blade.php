@extends('layouts.app')

@section('content')
<div class="container mt-3 d-flex justify-content-between align-items-center">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary btn-sm">
        <i class="fas fa-arrow-left"></i> Voltar para Tela Principal
    </a>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-outline-danger btn-sm">
            <i class="fas fa-sign-out-alt"></i> Sair
        </button>
    </form>
</div>

<div class="container mt-4">
    <h3 class="mb-4">Painel do Administrador</h3>

    @if(session('sucesso'))
        <div class="alert alert-success">{{ session('sucesso') }}</div>
    @endif

    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="card-title">Usuários Cadastrados</h5>
                    <p class="card-text display-6">{{ $totalUsuarios }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total de Registros</h5>
                    <p class="card-text display-6">{{ $totalRegistros }}</p>
                </div>
            </div>
        </div>
    </div>

    @if(auth()->user()->is_admin)
        <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
            <h4 class="mb-0">Lista de Usuários</h4>
            <a href="{{ route('admin.usuarios.criar') }}" class="btn btn-success btn-sm">
                <i class="fas fa-user-plus"></i> Novo Usuário/Admin
            </a>
        </div>

        <form method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="buscar" class="form-control" placeholder="Buscar por nome ou CPF..." value="{{ request('buscar') }}">
                <button type="submit" class="btn btn-outline-secondary">
                    <i class="fas fa-search"></i> Buscar
                </button>
            </div>
        </form>
    @endif

    <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Admin</th>
                <th>Telefone</th>
                <th>Cargo</th>
                <th>Setor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->cpf }}</td>
                    <td>{{ $usuario->is_admin ? 'Sim' : 'Não' }}</td>
                    <td>{{ $usuario->telefone }}</td>
                    <td>{{ $usuario->cargo }}</td>
                    <td>{{ $usuario->setor }}</td>
                    <td class="d-flex flex-wrap gap-1">
                        <a href="{{ route('admin.ver.dados', $usuario->id) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i>
                        </a>
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.usuarios.editar', $usuario->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('admin.usuarios.excluir', $usuario->id) }}" method="POST" onsubmit="return confirm('Deseja realmente excluir este usuário?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Nenhum usuário encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
