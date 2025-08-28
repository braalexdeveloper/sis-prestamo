@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Editar Préstamo</h2>

    <h4>Cliente: {{$loan->client->name}} {{$loan->client->lastName}}</h4>
    <!-- Formulario de préstamo -->
    <form action="{{ route('loans.update',$loan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="amount" class="form-label">Monto(s/)</label>
            <input type="number" name="amount" id="amount" class="form-control" value="{{$loan->amount}}" required>
        </div>

        <div class="mb-3">
            <label for="interest_rate" class="form-label">Tasa de Interés (%)</label>
            <input type="number" name="interest_rate" id="interest_rate" class="form-control" value="{{$loan->interest_rate}}" required>
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Fecha de Inicio</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{$loan->start_date}}" required>
        </div>

        <div class="mb-3">
            <label for="due_date" class="form-label">Fecha de Vencimiento</label>
            <input type="date" name="due_date" id="due_date" class="form-control" value="{{$loan->due_date}}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Estado de Prestamo</label>
            <select name="status" class="form-select">
                <option value="Pendiente" {{$loan->status =='Pendiente' ? 'selected' : ''}}>Pendiente</option>
                <option value="Pagado" {{$loan->status =='Pagado' ? 'selected' : ''}}>Pagado</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Guardar Préstamo</button>
        <a href="{{route('loans.index')}}" class="btn btn-secondary">Volver</a>
    </form>
</div>



@endsection
