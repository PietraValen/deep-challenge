@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary mb-1">Editar Processo</h2>
            <p class="text-muted small mb-0">Atualize as informações do processo</p>
        </div>
        <a href="{{ route('processes.index') }}" class="btn btn-outline-secondary rounded-3 shadow-sm">
            <i class="bi bi-arrow-left me-1"></i> Voltar
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <form action="{{ route('processes.update', $process) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <h5 class="fw-bold text-dark mb-4 border-bottom pb-2">Detalhes do Processo</h5>

                        <div class="mb-3">
                            <label for="client_id" class="form-label small fw-bold text-muted">Cliente</label>
                            <select class="form-select bg-light border-0 rounded-3 @error('client_id') is-invalid @enderror"
                                id="client_id" name="client_id" required>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id', $process->client_id) == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                                @endforeach
                            </select>
                            @error('client_id')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label small fw-bold text-muted">Título / Ação</label>
                            <input type="text"
                                class="form-control bg-light border-0 rounded-3 @error('title') is-invalid @enderror"
                                id="title" name="title" value="{{ old('title', $process->title) }}" required>
                            @error('title')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="number" class="form-label small fw-bold text-muted">Número do Processo</label>
                                <input type="text"
                                    class="form-control bg-light border-0 rounded-3 @error('number') is-invalid @enderror"
                                    id="number" name="number" value="{{ old('number', $process->number) }}">
                                @error('number')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="court" class="form-label small fw-bold text-muted">Vara / Tribunal</label>
                                <input type="text"
                                    class="form-control bg-light border-0 rounded-3 @error('court') is-invalid @enderror"
                                    id="court" name="court" value="{{ old('court', $process->court) }}">
                                @error('court')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="status" class="form-label small fw-bold text-muted">Status</label>
                                <select
                                    class="form-select bg-light border-0 rounded-3 @error('status') is-invalid @enderror"
                                    id="status" name="status" required>
                                    <option value="Em Andamento" {{ old('status', $process->status) == 'Em Andamento' ? 'selected' : '' }}>Em Andamento</option>
                                    <option value="Concluído" {{ old('status', $process->status) == 'Concluído' ? 'selected' : '' }}>Concluído</option>
                                    <option value="Arquivado" {{ old('status', $process->status) == 'Arquivado' ? 'selected' : '' }}>Arquivado</option>
                                </select>
                                @error('status')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="value" class="form-label small fw-bold text-muted">Valor da Causa (R$)</label>
                                <input type="text"
                                    class="form-control bg-light border-0 rounded-3 @error('value') is-invalid @enderror"
                                    id="value" name="value"
                                    value="{{ old('value', number_format($process->value, 2, ',', '.')) }}">
                                @error('value')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label small fw-bold text-muted">Descrição /
                                Observações</label>
                            <textarea
                                class="form-control bg-light border-0 rounded-3 @error('description') is-invalid @enderror"
                                id="description" name="description"
                                rows="4">{{ old('description', $process->description) }}</textarea>
                            @error('description')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary rounded-3 shadow-sm fw-semibold px-4">Atualizar
                                Processo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection