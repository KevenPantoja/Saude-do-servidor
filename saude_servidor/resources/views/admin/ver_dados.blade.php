@extends('layouts.app')

@section('content')
<div class="container mt-3 d-flex justify-content-between">
    <a href="{{ route('admin.index') }}" class="btn btn-outline-secondary btn-sm">Voltar para Tela Principal</a>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-outline-danger btn-sm">Sair</button>
    </form>
</div>

<div class="container mt-4">
    <h3 class="mb-4">Dados do Usuário: {{ $usuario->name }}</h3>

    @if(session('sucesso'))
        <div class="alert alert-success">{{ session('sucesso') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Data</th>
                <th>Idade</th>
                <th>Peso</th>
                <th>Altura</th>
                <th>IMC</th>
                <th>Abdômen</th>
                <th>Diabético</th>
                <th>Pressão Alta</th>
                <th>Dores Articulares</th>
                <th>Atividade Física</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dados as $dado)
                <tr>
                    <td>{{ $dado->data_registro }}</td>
                    <td>{{ $dado->idade }}</td>
                    <td>{{ $dado->peso }}</td>
                    <td>{{ $dado->altura }}</td>
                    <td>{{ $dado->imc }}</td>
                    <td>{{ $dado->circunferencia_abdominal }}</td>
                    <td>{{ $dado->diabetico ? 'Sim' : 'Não' }}</td>
                    <td>{{ $dado->pressao_alta ? 'Sim' : 'Não' }}</td>
                    <td>{{ $dado->dores_articulacoes ? 'Sim' : 'Não' }}</td>
                    <td>{{ $dado->atividade_fisica ? 'Sim' : 'Não' }}</td>
                    <td>
                        <form action="{{ route('admin.excluir.dado', $dado->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este registro?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
