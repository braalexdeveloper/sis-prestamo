@extends('layouts.dashboard') {{-- Usa tu layout principal --}}

@section('content')
<div class="container-fluid mt-4">
    {{-- Título y botón para crear nuevo rol --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Lista de Clientes</h2>
        <a href="{{ route('clients.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nuevo Cliente
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
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Dni</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clients as $index => $client)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->lastName }}</td>
                            <td>{{ $client->dni }}</td>
                            <td>{{ $client->phone }}</td>
                            <td>{{ $client->address }}</td>
                            <td>
                                <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este cliente?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No hay clientes registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
