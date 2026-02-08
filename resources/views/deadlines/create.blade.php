@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary mb-1">Novo Prazo</h2>
            <p class="text-muted small mb-0">Agende um novo compromisso ou prazo</p>
        </div>
        <a href="{{ route('deadlines.index') }}" class="btn btn-outline-secondary rounded-3 shadow-sm">
            <i class="bi bi-arrow-left me-1"></i> Voltar
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <form action="{{ route('deadlines.store') }}" method="POST">
                        @csrf

                        <h5 class="fw-bold text-dark mb-4 border-bottom pb-2">Detalhes do Prazo</h5>

                        <div class="mb-3">
                            <label for="title" class="form-label small fw-bold text-muted">Título</label>
                            <input type="text"
                                class="form-control bg-light border-0 rounded-3 @error('title') is-invalid @enderror"
                                id="title" name="title" value="{{ old('title') }}"
                                placeholder="Ex: Audiência de Conciliação" required autofocus>
                            @error('title')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="process_id" class="form-label small fw-bold text-muted">Processo Relacionado
                                (Opcional)</label>
                            <select
                                class="form-select bg-light border-0 rounded-3 @error('process_id') is-invalid @enderror"
                                id="process_id" name="process_id">
                                <option value="">Nenhum</option>
                                @foreach($processes as $process)
                                    <option value="{{ $process->id }}" {{ old('process_id') == $process->id ? 'selected' : '' }}>
                                        {{ $process->title }} ({{ $process->number ?? 'S/N' }})</option>
                                @endforeach
                            </select>
                            @error('process_id')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="due_date" class="form-label small fw-bold text-muted">Data e Hora de
                                    Vencimento</label>
                                <input type="datetime-local"
                                    class="form-control bg-light border-0 rounded-3 @error('due_date') is-invalid @enderror"
                                    id="due_date" name="due_date" value="{{ old('due_date') }}" required>
                                @error('due_date')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="form-label small fw-bold text-muted">Status</label>
                                <select
                                    class="form-select bg-light border-0 rounded-3 @error('status') is-invalid @enderror"
                                    id="status" name="status" required>
                                    <option value="Pendente" {{ old('status') == 'Pendente' ? 'selected' : '' }}>Pendente
                                    </option>
                                    <option value="Concluído" {{ old('status') == 'Concluído' ? 'selected' : '' }}>Concluído
                                    </option>
                                </select>
                                @error('status')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label small fw-bold text-muted">Descrição /
                                Detalhes</label>
                            <textarea
                                class="form-control bg-light border-0 rounded-3 @error('description') is-invalid @enderror"
                                id="description" name="description" rows="4">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary rounded-3 shadow-sm fw-semibold px-4">Salvar
                                Prazo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection