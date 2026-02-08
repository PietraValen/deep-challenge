@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary mb-1">Meus Clientes</h2>
            <p class="text-muted small mb-0">Gerencie sua carteira de clientes</p>
        </div>
        <a href="{{ route('clients.create') }}" class="btn btn-primary rounded-3 shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Novo Cliente
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
                        <th class="ps-4 py-3 text-uppercase text-muted small fw-bold">Nome</th>
                        <th class="py-3 text-uppercase text-muted small fw-bold">Contato</th>
                        <th class="py-3 text-uppercase text-muted small fw-bold">Documento</th>
                        <th class="text-end pe-4 py-3 text-uppercase text-muted small fw-bold">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clients as $client)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center me-3"
                                        style="width: 40px; height: 40px;">
                                        {{ substr($client->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-semibold text-dark">{{ $client->name }}</h6>
                                        <small class="text-muted">Adicionado em
                                            {{ $client->created_at->format('d/m/Y') }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    @if($client->email)
                                        <span class="text-muted small"><i class="bi bi-envelope me-1"></i>
                                            {{ $client->email }}</span>
                                    @endif
                                    @if($client->phone)
                                        <span class="text-muted small"><i class="bi bi-telephone me-1"></i>
                                            {{ $client->phone }}</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">{{ $client->document ?? 'N/A' }}</span>
                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-group">
                                    <a href="{{ route('clients.edit', $client) }}"
                                        class="btn btn-sm btn-outline-secondary rounded-start-pill" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('clients.destroy', $client) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Tem certeza que deseja excluir este cliente?');">
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
                            <td colspan="4" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bi bi-people display-4 mb-3 d-block text-secondary"></i>
                                    <p class="mb-0">Nenhum cliente cadastrado ainda.</p>
                                    <a href="{{ route('clients.create') }}" class="btn btn-link text-decoration-none">Cadastrar
                                        primeiro cliente</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-4 py-3 border-top">
            {{ $clients->links() }}
        </div>
    </div>
@endsection