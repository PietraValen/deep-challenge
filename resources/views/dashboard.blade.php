@extends('layouts.app')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="mb-0">Painel de Controle</h2>
            <p class="text-muted">Bem-vindo ao seu escritório virtual.</p>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <!-- Processos Card -->
        <div class="col-md-4">
            <div class="card bg-primary text-white p-3 rounded-4 shadow-sm border-0 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0 fw-light">Processos Ativos</h5>
                        <h2 class="fw-bold display-6 mb-0">{{ $counts['processes'] }}</h2>
                    </div>
                    <i class="bi bi-file-earmark-text display-4 opacity-50"></i>
                </div>
            </div>
        </div>

        <!-- Prazos Card -->
        <div class="col-md-4">
            <div class="card bg-success text-white p-3 rounded-4 shadow-sm border-0 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0 fw-light">Prazos Pendentes</h5>
                        <h2 class="fw-bold display-6 mb-0">{{ $counts['deadlines'] }}</h2>
                    </div>
                    <i class="bi bi-calendar-check display-4 opacity-50"></i>
                </div>
            </div>
        </div>

        <!-- Clientes Card -->
        <div class="col-md-4">
            <div class="card bg-info text-white p-3 rounded-4 shadow-sm border-0 h-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0 fw-light">Total de Clientes</h5>
                        <h2 class="fw-bold display-6 mb-0">{{ $counts['clients'] }}</h2>
                    </div>
                    <i class="bi bi-people display-4 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Upcoming Deadlines -->
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white py-3 border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold text-dark">Prazos Próximos</h5>
                        <a href="{{ route('deadlines.index') }}" class="btn btn-sm btn-link text-decoration-none">Ver todos</a>
                    </div>
                </div>
                <div class="list-group list-group-flush rounded-bottom-4">
                    @forelse($upcomingDeadlines as $deadline)
                        <div class="list-group-item px-4 py-3 d-flex align-items-center justify-content-between border-light">
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded p-2 me-3 text-primary">
                                    <i class="bi bi-calendar-event h5 mb-0"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-semibold text-dark">{{ $deadline->title }}</h6>
                                    <small class="text-muted">
                                        {{ $deadline->due_date->format('d/m/Y H:i') }}
                                        @if($deadline->process)
                                            <span class="mx-1">•</span> <i class="bi bi-file-earmark-text small"></i> {{ $deadline->process->title }}
                                        @endif
                                    </small>
                                </div>
                            </div>
                            <span class="badge {{ $deadline->due_date->isPast() ? 'bg-danger-subtle text-danger' : 'bg-warning-subtle text-warning-emphasis' }} rounded-pill px-3 py-2">
                                {{ $deadline->due_date->diffForHumans() }}
                            </span>
                        </div>
                    @empty
                        <div class="text-center py-5 text-muted">
                            <i class="bi bi-calendar-check display-4 mb-3 d-block text-secondary opacity-50"></i>
                            <p class="mb-0">Nenhum prazo próximo.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection