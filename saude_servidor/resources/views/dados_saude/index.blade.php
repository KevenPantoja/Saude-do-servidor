@extends('layouts.app')

@section('content')
<div class="container mt-3 d-flex justify-content-between">
    <a href="{{ route('dados.index') }}" class="btn btn-outline-secondary btn-sm">Voltar para Tela Principal</a>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-outline-danger btn-sm">Sair</button>
    </form>
</div>

<div class="container">
    <h2>Dados de Saúde</h2>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif

    @if(!$preencheuHoje)
    <form action="{{ route('dados.store') }}" method="POST">
        @csrf
        <div>
            <label>Endereço:</label>
            <input type="text" name="endereco" required>
        </div>

        <div>
            <label>Idade:</label>
            <input type="number" name="idade" required>
        </div>

        <div>
            <label>Altura (em metros):</label>
            <input type="text" name="altura" required>
        </div>

        <div>
            <label>Peso (em kg):</label>
            <input type="text" name="peso" required>
        </div>

        <div>
            <label>Circunferência Abdominal (cm):</label>
            <input type="number" name="circunferencia_abdominal">
        </div>

        <div>
            <label><input type="checkbox" name="diabetico"> Diabético</label>
            <label><input type="checkbox" name="pressao_alta"> Pressão Alta</label>
            <label><input type="checkbox" name="dores_articulacoes"> Dores nas Articulações</label>
            <label><input type="checkbox" name="atividade_fisica"> Atividade Física</label>
        </div>

        <button type="submit">Salvar</button>
    </form>
    @else
        <p>Você já preencheu seus dados hoje.</p>
    @endif

    <hr>

    <h3>Histórico</h3>
    <ul>
        @foreach($dados as $dado)
            <li>
                <strong>{{ $dado->data_registro->format('d/m/Y') }}</strong>: IMC: {{ $dado->imc }}, Peso: {{ $dado->peso }}kg,
                Altura: {{ $dado->altura }}m
                <form action="{{ route('dados.destroy', $dado->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Deseja mesmo remover (será mantido no histórico)?')">Remover</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
@endsection
