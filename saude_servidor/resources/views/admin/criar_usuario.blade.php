@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Criar Novo Usuário</h3>

    <form method="POST" action="{{ route('admin.usuarios.salvar') }}">
        @csrf

        <div class="mb-3">
            <label for="name">Nome</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="cpf">CPF</label>
            <input type="text" name="cpf" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" class="form-control">
        </div>

        <div class="mb-3">
            <label for="cargo">Cargo</label>
            <input type="text" name="cargo" class="form-control">
        </div>

        <div class="mb-3">
            <label for="setor">Setor</label>
            <input type="text" name="setor" class="form-control">
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_admin" class="form-check-input" id="is_admin">
            <label class="form-check-label" for="is_admin">Administrador</label>
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
