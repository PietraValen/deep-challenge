@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary mb-1">Meus Processos</h2>
            <p class="text-muted small mb-0">Gerencie seus processos jurídicos</p>
        </div>
        <a href="{{ route('processes.create') }}" class="btn btn-primary rounded-3 shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Novo Processo
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
                        <th class="ps-4 py-3 text-uppercase text-muted small fw-bold">Processo</th>
                        <th class="py-3 text-uppercase text-muted small fw-bold">Cliente</th>
                        <th class="py-3 text-uppercase text-muted small fw-bold">Vara/Tribunal</th>
                        <th class="py-3 text-uppercase text-muted small fw-bold">Status</th>
                        <th class="text-end pe-4 py-3 text-uppercase text-muted small fw-bold">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($processes as $process)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-0 fw-semibold text-dark">{{ $process->title }}</h6>
                                    <small class="text-muted">Nº {{ $process->number ?? 'S/N' }}</small>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center me-2"
                                        style="width: 32px; height: 32px; font-size: 0.8rem;">
                                        {{ substr($process->client->name, 0, 1) }}
                                    </div>
                                    <span class="text-dark">{{ $process->client->name }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="text-muted">{{ $process->court ?? '-' }}</span>
                            </td>
                            <td>
                                @php
                                    $statusClass = match ($process->status) {
                                        'Em Andamento' => 'bg-warning-subtle text-warning-emphasis',
                                        'Concluído' => 'bg-success-subtle text-success-emphasis',
                                        'Arquivado' => 'bg-secondary-subtle text-secondary-emphasis',
                                        default => 'bg-light text-dark'
                                    };
                                @endphp
                                <span
                                    class="badge {{ $statusClass }} border border-{{ str_replace(['bg-', '-subtle'], '', $statusClass) }}">{{ $process->status }}</span>
                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-group">
                                    <a href="{{ route('processes.edit', $process) }}"
                                        class="btn btn-sm btn-outline-secondary rounded-start-pill" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('processes.destroy', $process) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Tem certeza que deseja excluir este processo?');">
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
                                    <i class="bi bi-file-earmark-text display-4 mb-3 d-block text-secondary"></i>
                                    <p class="mb-0">Nenhum processo cadastrado ainda.</p>
                                    <a href="{{ route('processes.create') }}"
                                        class="btn btn-link text-decoration-none">Cadastrar primeiro processo</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-4 py-3 border-top">
            {{ $processes->links() }}
        </div>
    </div>
@endsection