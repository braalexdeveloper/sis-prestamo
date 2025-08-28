@extends('layouts.dashboard') {{-- Usa tu layout principal --}}

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm rounded-3">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Actualizar Cliente</h4>
                </div>
                <div class="card-body">
                    {{-- Mostrar errores de validación --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Formulario para crear cliente --}}
                    <form action="{{ route('clients.update',$client->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre </label>
                            <input type="text" name="name" id="name" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name',$client->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="lastName" class="form-label">Apellidos </label>
                            <input type="text" name="lastName" id="lastName" 
                                   class="form-control @error('lastName') is-invalid @enderror" 
                                   value="{{ old('lastName',$client->lastName) }}" required>
                            @error('lastName')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                         <div class="mb-3">
                            <label for="dni" class="form-label">DNI </label>
                            <input type="text" name="dni" id="dni" 
                                   class="form-control @error('dni') is-invalid @enderror" 
                                   value="{{ old('dni',$client->dni) }}" required>
                            @error('dni')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                         <div class="mb-3">
                            <label for="phone" class="form-label">Celular </label>
                            <input type="text" name="phone" id="phone" 
                                   class="form-control @error('phone') is-invalid @enderror" 
                                   value="{{ old('phone',$client->phone) }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                         <div class="mb-3">
                            <label for="address" class="form-label">Dirección</label>
                            <input type="text" name="address" id="address" 
                                   class="form-control @error('address') is-invalid @enderror" 
                                   value="{{ old('address',$client->address) }}" required>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('clients.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Volver
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save"></i> Guardar Cliente
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
