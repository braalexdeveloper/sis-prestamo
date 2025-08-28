@extends('layouts.dashboard') {{-- Usa tu layout principal --}}

@section('content')
<div class="container-fluid mt-4">
    {{-- Título y botón para crear nuevo rol --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Lista de Roles</h2>
        <a href="{{ route('roles.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nuevo Rol
        </a>
    </div>

    {{-- Mensajes de éxito o error --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Tabla de roles --}}
    <div class="card shadow-sm rounded-3">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roles as $index => $role)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->description ?? 'Sin descripción' }}</td>
                            <td>
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i> Editar
                                </a>
                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este rol?')">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No hay roles registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
