@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary mb-1">Novo Cliente</h2>
            <p class="text-muted small mb-0">Cadastre um novo cliente na sua carteira</p>
        </div>
        <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary rounded-3 shadow-sm">
            <i class="bi bi-arrow-left me-1"></i> Voltar
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <form action="{{ route('clients.store') }}" method="POST">
                        @csrf

                        <h5 class="fw-bold text-dark mb-4 border-bottom pb-2">Informações Pessoais</h5>

                        <div class="mb-3">
                            <label for="name" class="form-label small fw-bold text-muted">Nome Completo</label>
                            <input type="text"
                                class="form-control bg-light border-0 rounded-3 @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label small fw-bold text-muted">Email</label>
                                <input type="email"
                                    class="form-control bg-light border-0 rounded-3 @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="document" class="form-label small fw-bold text-muted">Documento
                                    (CPF/CNPJ)</label>
                                <input type="text"
                                    class="form-control bg-light border-0 rounded-3 @error('document') is-invalid @enderror"
                                    id="document" name="document" value="{{ old('document') }}">
                                @error('document')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="phone" class="form-label small fw-bold text-muted">Telefone</label>
                            <input type="text"
                                class="form-control bg-light border-0 rounded-3 @error('phone') is-invalid @enderror"
                                id="phone" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <h5 class="fw-bold text-dark mb-4 border-bottom pb-2 pt-2">Endereço e Notas</h5>

                        <div class="mb-3">
                            <label for="address" class="form-label small fw-bold text-muted">Endereço Completo</label>
                            <textarea
                                class="form-control bg-light border-0 rounded-3 @error('address') is-invalid @enderror"
                                id="address" name="address" rows="2">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="notes" class="form-label small fw-bold text-muted">Notas Adicionais</label>
                            <textarea class="form-control bg-light border-0 rounded-3 @error('notes') is-invalid @enderror"
                                id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary rounded-3 shadow-sm fw-semibold px-4">Salvar
                                Cliente</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection