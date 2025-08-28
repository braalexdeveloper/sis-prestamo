@extends('layouts.dashboard') {{-- Usa tu layout principal --}}

@section('content')
<div class="container-fluid mt-4">
    {{-- Título y botón para crear nuevo rol --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Lista de Prestamos</h2>
        <a href="{{ route('loans.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nuevo Prestamo
        </a>
    </div>

    {{-- Mensajes de éxito o error --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    
    <div class="card shadow-sm rounded-3">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Monto(s/)</th>
                        <th>Interes(%)</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($loans as $index => $loan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $loan->client->name }}</td>
                            <td>{{ $loan->amount }}</td>
                            <td>{{ $loan->interest_rate }}</td>
                            <td>{{ $loan->start_date }}</td>
                            <td>{{ $loan->due_date }}</td>
                            <td><span class="badge {{$loan->status=='Pendiente' ? 'text-bg-danger' : 'text-bg-success'}}">{{ $loan->status }}</span></td>
                            <td>
                                <a href="{{ route('loans.edit', $loan->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este prestamo?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No hay prestamos registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
