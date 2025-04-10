@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Editar Usuário</h3>

    <form method="POST" action="{{ route('admin.usuarios.atualizar', $usuario->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name">Nome</label>
            <input type="text" name="name" value="{{ $usuario->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" value="{{ $usuario->telefone }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="cargo">Cargo</label>
            <input type="text" name="cargo" value="{{ $usuario->cargo }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="setor">Setor</label>
            <input type="text" name="setor" value="{{ $usuario->setor }}" class="form-control">
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_admin" id="is_admin" class="form-check-input" {{ $usuario->is_admin ? 'checked' : '' }}>
            <label class="form-check-label" for="is_admin">Administrador</label>
        </div>

        <button type="submit" class="btn btn-success">Atualizar</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
