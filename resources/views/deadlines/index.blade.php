@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary mb-1">Meus Prazos</h2>
            <p class="text-muted small mb-0">Gerencie seus compromissos e prazos judiciais</p>
        </div>
        <a href="{{ route('deadlines.create') }}" class="btn btn-primary rounded-3 shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Novo Prazo
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm border-0" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3 text-uppercase text-muted small fw-bold">Título</th>
                        <th class="py-3 text-uppercase text-muted small fw-bold">Processo Relacionado</th>
                        <th class="py-3 text-uppercase text-muted small fw-bold">Data de Vencimento</th>
                        <th class="py-3 text-uppercase text-muted small fw-bold">Status</th>
                        <th class="text-end pe-4 py-3 text-uppercase text-muted small fw-bold">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($deadlines as $deadline)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-0 fw-semibold text-dark">{{ $deadline->title }}</h6>
                                    @if($deadline->description)
                                        <small class="text-muted text-truncate"
                                            style="max-width: 250px;">{{ $deadline->description }}</small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                @if($deadline->process)
                                    <a href="{{ route('processes.edit', $deadline->process) }}"
                                        class="text-decoration-none fw-medium text-primary">
                                        <i class="bi bi-file-earmark-text me-1"></i> {{ $deadline->process->title }}
                                    </a>
                                @else
                                    <span class="text-muted small">Nenhum</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-calendar-event me-2 text-muted"></i>
                                    <span
                                        class="fw-medium {{ $deadline->due_date->isPast() && $deadline->status !== 'Concluído' ? 'text-danger' : 'text-dark' }}">
                                        {{ $deadline->due_date->format('d/m/Y H:i') }}
                                    </span>
                                </div>
                            </td>
                            <td>
                                @php
                                    $statusClass = match ($deadline->status) {
                                        'Pendente' => 'bg-warning-subtle text-warning-emphasis',
                                        'Concluído' => 'bg-success-subtle text-success-emphasis',
                                        default => 'bg-light text-dark'
                                    };
                                @endphp
                                <span
                                    class="badge {{ $statusClass }} border border-{{ str_replace(['bg-', '-subtle'], '', $statusClass) }}">{{ $deadline->status }}</span>
                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-group">
                                    <a href="{{ route('deadlines.edit', $deadline) }}"
                                        class="btn btn-sm btn-outline-secondary rounded-start-pill" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('deadlines.destroy', $deadline) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Tem certeza que deseja excluir este prazo?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-end-pill"
                                            title="Excluir">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bi bi-calendar-check display-4 mb-3 d-block text-secondary"></i>
                                    <p class="mb-0">Nenhum prazo cadastrado ainda.</p>
                                    <a href="{{ route('deadlines.create') }}"
                                        class="btn btn-link text-decoration-none">Cadastrar primeiro prazo</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-4 py-3 border-top">
            {{ $deadlines->links() }}
        </div>
    </div>
@endsection