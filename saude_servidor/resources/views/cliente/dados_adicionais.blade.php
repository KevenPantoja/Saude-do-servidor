@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-4">
        <a href="{{ route('dashboard.usuario') }}" class="btn btn-outline-primary btn-sm">Voltar para Tela Principal</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm">Sair</button>
        </form>
    </div>

    <h3 class="mb-4">Cadastro de Dados de Saúde</h3>

    @if(session('erro'))
        <div class="alert alert-danger">{{ session('erro') }}</div>
    @endif

    @if(session('sucesso'))
        <div class="alert alert-success">{{ session('sucesso') }}</div>
    @endif

    <form method="POST" action="{{ route('dados.store') }}">
        @csrf

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="endereco" class="form-label">Endereço</label>
                <input type="text" name="endereco" class="form-control" required>
            </div>

            <div class="col-md-3">
                <label for="idade" class="form-label">Idade</label>
                <input type="number" name="idade" class="form-control" required>
            </div>

            <div class="col-md-3">
                <label for="data_registro" class="form-label">Data de Nascimento</label>
                <input type="date" name="data_registro" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="peso" class="form-label">Peso (kg)</label>
                <input type="number" id="peso" name="peso" class="form-control" step="0.01" required>
            </div>

            <div class="col-md-4">
                <label for="altura" class="form-label">Altura (m)</label>
                <input type="number" id="altura" name="altura" class="form-control" step="0.01" required>
            </div>

            <div class="col-md-4">
                <label for="imc" class="form-label">IMC</label>
                <input type="text" id="imc" name="imc" class="form-control" readonly required>
            </div>
        </div>

        <div class="mb-3">
            <label for="circunferencia_abdominal" class="form-label">Circunferência Abdominal (cm)</label>
            <input type="number" name="circunferencia_abdominal" class="form-control" required>
        </div>

        <div class="mb-3">
            <div class="form-check form-check-inline">
                <input type="checkbox" name="diabetico" value="1" class="form-check-input" id="diabetico">
                <label class="form-check-label" for="diabetico">Diabético?</label>
            </div>

            <div class="form-check form-check-inline">
                <input type="checkbox" name="pressao_alta" value="1" class="form-check-input" id="pressao_alta">
                <label class="form-check-label" for="pressao_alta">Pressão Alta?</label>
            </div>

            <div class="form-check form-check-inline">
                <input type="checkbox" name="dores_articulacoes" value="1" class="form-check-input" id="dores_articulacoes">
                <label class="form-check-label" for="dores_articulacoes">Dores nas articulações?</label>
            </div>

            <div class="form-check form-check-inline">
                <input type="checkbox" name="atividade_fisica" value="1" class="form-check-input" id="atividade_fisica">
                <label class="form-check-label" for="atividade_fisica">Atividade física?</label>
            </div>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-success">Salvar Dados</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const pesoInput = document.getElementById('peso');
        const alturaInput = document.getElementById('altura');
        const imcInput = document.getElementById('imc');

        function calcularIMC() {
            const peso = parseFloat(pesoInput.value);
            const altura = parseFloat(alturaInput.value);

            if (peso > 0 && altura > 0) {
                const imc = peso / (altura * altura);
                imcInput.value = imc.toFixed(2);
            } else {
                imcInput.value = '';
            }
        }

        pesoInput.addEventListener('input', calcularIMC);
        alturaInput.addEventListener('input', calcularIMC);
    });
</script>
@endsection
