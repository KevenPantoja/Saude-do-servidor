<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - Novo Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card shadow rounded-3">
                    <div class="card-header bg-success text-white text-center">
                        <h4>Cadastro de Usuário</h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ url('/register') }}">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Nome</label>
                                    <input type="text" name="nome" class="form-control" value="{{ old('nome') }}" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">CPF</label>
                                    <input type="text" name="cpf" class="form-control" value="{{ old('cpf') }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Telefone</label>
                                    <input type="text" name="telefone" class="form-control" value="{{ old('telefone') }}" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Cargo</label>
                                    <input type="text" name="cargo" class="form-control" value="{{ old('cargo') }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Setor</label>
                                <input type="text" name="setor" class="form-control" value="{{ old('setor') }}" required>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Senha</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Confirme a Senha</label>
                                    <input type="password" name="password_confirmation" class="form-control" required>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Cadastrar</button>
                            </div>
                        </form>
                        <div class="text-center mt-3">
                            <a href="{{ route('login') }}">Já possui conta? Faça login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
