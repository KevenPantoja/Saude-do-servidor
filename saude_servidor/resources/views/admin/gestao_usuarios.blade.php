@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Painel de Gestão de Usuários</h3>

    @if(session('sucesso'))
        <div class="alert alert-success">{{ session('sucesso') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.criar.usuario') }}" class="mb-4">
        @csrf
        <div class="row">
            <div class="col-md-4"><input name="name" class="form-control" placeholder="Nome" required></div>
            <div class="col-md-4"><input name="cpf" class="form-control" placeholder="CPF" required></div>
            <div class="col-md-4"><input name="telefone" class="form-control" placeholder="Telefone" required></div>
        </div>
        <div class="row mt-2">
            <div class="col-md-4"><input name="cargo" class="form-control" placeholder="Cargo" required></div>
            <div class="col-md-4"><input name="setor" class="form-control" placeholder="Setor" required></div>
            <div class="col-md-4 form-check mt-2">
                <input type="checkbox" name="is_admin" class="form-check-input" id="is_admin">
                <label for="is_admin" class="form-check-label">Administrador</label>
            </div>
        </div>
        <div class="mt-3">
            <button class="btn btn-success">Cadastrar Usuário</button>
        </div>
    </form>

    <h5>Usuários Cadastrados</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome</th><th>CPF</th><th>Telefone</th><th>Cargo</th><th>Setor</th><th>Admin</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->cpf }}</td>
                    <td>{{ $user->telefone }}</td>
                    <td>{{ $user->cargo }}</td>
                    <td>{{ $user->setor }}</td>
                    <td>{{ $user->is_admin ? 'Sim' : 'Não' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
