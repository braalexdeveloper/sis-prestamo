@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Crear Préstamo</h2>

    <!-- Campo para buscar cliente -->
    <div class="mb-3">
        <label for="dni" class="form-label">DNI del Cliente</label>
        <input type="text" id="dni" class="form-control">
        <button type="button" id="btnBuscar" class="btn btn-primary mt-2">Buscar</button>
    </div>

    <!-- Mostrar datos del cliente -->
    <div id="client-info" class="alert alert-info d-none"></div>

    <!-- Formulario de préstamo -->
    <form action="{{ route('loans.store') }}" method="POST">
        @csrf
        <input type="hidden" name="client_id" id="client_id">

        <div class="mb-3">
            <label for="amount" class="form-label">Monto(s/)</label>
            <input type="number" name="amount" id="amount" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="interest_rate" class="form-label">Tasa de Interés (%)</label>
            <input type="number" name="interest_rate" id="interest_rate" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Fecha de Inicio</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="due_date" class="form-label">Fecha de Vencimiento</label>
            <input type="date" name="due_date" id="due_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar Préstamo</button>
        <a href="{{route('loans.index')}}" class="btn btn-secondary">Volver</a>
    </form>
</div>



<script>
document.getElementById("btnBuscar").addEventListener("click", async function(){
    let dni = document.getElementById("dni").value.trim();
    
    // Construir URL con parámetros GET
    const url = `{{ route("loans.getClientByDni") }}?dni=${encodeURIComponent(dni)}`;
    
    try {
        const response = await fetch(url, {
            method: 'GET',
            headers: {
                //'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                //'X-CSRF-TOKEN': '{{ csrf_token() }}' // Por si acaso
            }
        });

        
        if (response.ok) {
            const data = await response.json();
            console.log('Respuesta GET:', data);
            
            if(data.status === 'success') {
                document.getElementById("client-info").classList.remove("d-none", "alert-danger");
                document.getElementById("client-info").classList.add("alert-success");
                document.getElementById("client-info").innerHTML = 
                    `Cliente encontrado: ${data.client.name} - ${data.client.dni}`;
                document.getElementById("client-info").style.display = 'block';
                document.getElementById("client_id").value = data.client.id;
            } else {
                document.getElementById("client-info").classList.remove("d-none", "alert-success");
                document.getElementById("client-info").classList.add("alert-danger");
                document.getElementById("client-info").innerHTML = data.message;
                document.getElementById("client-info").style.display = 'block';
                document.getElementById("client_id").value = '';
            }
        } else {
            const errorText = await response.text();
            console.error('Error HTTP:', response.status, errorText);
            throw new Error(`Error ${response.status}: ${errorText}`);
        }
        
    } catch (error) {
        console.error('Error en Fetch GET:', error);
        document.getElementById("client-info").classList.remove("d-none", "alert-success");
        document.getElementById("client-info").classList.add("alert-danger");
        document.getElementById("client-info").innerHTML = 'Error: ' + error.message;
        document.getElementById("client-info").style.display = 'block';
    }
});


</script>
@endsection
