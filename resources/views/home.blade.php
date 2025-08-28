@extends('layouts.dashboard')

@section('content')
    <h1>Bienvenido al Dashboard</h1>
    <p>Este es un ejemplo de panel de administración para tu sistema de préstamos.</p>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Clientes</h5>
                    <p class="card-text">Total: 10</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Préstamos</h5>
                    <p class="card-text">Total: 5</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Pagos</h5>
                    <p class="card-text">Total: 3</p>
                </div>
            </div>
        </div>
    </div>
@endsection
