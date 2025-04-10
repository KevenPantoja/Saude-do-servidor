@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Bem-vindo, {{ $user->nome }}</h2>

    <div class="mb-3">
        <p><strong>CPF:</strong> {{ $user->cpf }}</p>
        <p><strong>Setor:</strong> {{ $user->setor }} | <strong>Cargo:</strong> {{ $user->cargo }}</p>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Últimos dados de saúde registrados
        </div>
        <div class="card-body">
            @if($ultimoDado)
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Data:</strong> {{ $ultimoDado->data_registro->format('d/m/Y') }}</li>
                    <li class="list-group-item"><strong>IMC:</strong> {{ number_format($ultimoDado->imc, 2) }}</li>
                    <li class="list-group-item"><strong>Peso:</strong> {{ $ultimoDado->peso }} kg</li>
                    <li class="list-group-item"><strong>Altura:</strong> {{ $ultimoDado->altura }} m</li>
                    <li class="list-group-item"><strong>Pressão Alta:</strong> {{ $ultimoDado->pressao_alta ? 'Sim' : 'Não' }}</li>
                    <li class="list-group-item"><strong>Diabético:</strong> {{ $ultimoDado->diabetico ? 'Sim' : 'Não' }}</li>
                    <li class="list-group-item"><strong>Atividade Física:</strong> {{ $ultimoDado->atividade_fisica ? 'Sim' : 'Não' }}</li>
                </ul>
            @else
                <p class="text-muted">Nenhum dado de saúde registrado ainda.</p>
            @endif
        </div>
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('cliente.dados.adicionais') }}" class="btn btn-outline-primary">Preencher Dados Pessoais</a>
        <a href="{{ route('dados.index') }}" class="btn btn-outline-success">Preencher Dados de Saúde</a>
    </div>
</div>
@endsection
