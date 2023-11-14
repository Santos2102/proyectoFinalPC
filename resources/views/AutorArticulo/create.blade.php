@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
<section class="content container-fluid mt-4">
    <div class="row">
        <div class="col-md-12">
            @includeif('partials.errors')

            <div class="card card-default">
                <div class="card-header">
                    <h5 class="card-title">{{ __('Crear nuevo') }}</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('storeAutorArticulo') }}" role="form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="autores">Selecciona uno o más autores:</label>
                            <select name="autores[]" id="autores" class="form-control" multiple required>
                                @foreach ($autor as $item)
                                    <option value="{{ encrypt($item->idAutor) }}">{{ $item->nombre }} {{ $item->apellido }}</option>
                                @endforeach
                            </select>
                            @error('autores')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <!-- Mostrar autores seleccionados -->
                        <div class="form-group">
                            <label>Autores Seleccionados:</label>
                            <ul id="autoresSeleccionados"></ul>
                        </div>

                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" required placeholder="Título" class="form-control">
                            @error('titulo')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="resumen">Resumen</label>
                            <textarea name="resumen" id="resumen" required placeholder="Resumen" class="form-control">{{ old('resumen') }}</textarea>
                            @error('resumen')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="contenido">Contenido</label>
                            <textarea name="contenido" id="contenido" required placeholder="Contenido" class="form-control">{{ old('contenido') }}</textarea>
                            @error('contenido')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fecha">Fecha</label>
                            <input type="date" name="fecha" id="fecha" value="{{ old('fecha') }}" required placeholder="Fecha" class="form-control">
                            @error('fecha')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <input type="hidden" name="activo" value="1">
                        <div class="box-footer mt-4">
                            <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var autoresSelect = document.getElementById("autores");
    var autoresSeleccionados = document.getElementById("autoresSeleccionados");

    // Agregar evento de doble clic a los elementos del select
    autoresSelect.addEventListener("dblclick", function(e) {
        // Verificar si el evento proviene de un doble clic
        if (e.detail === 2) {
            // Obtener el elemento seleccionado
            var selectedOption = autoresSelect.options[autoresSelect.selectedIndex];

            // Agregar el autor a la lista
            var autor = document.createElement("li");
            autor.textContent = selectedOption.text;
            autoresSeleccionados.appendChild(autor);

            // Deseleccionar el elemento en el select
            selectedOption.selected = false;
        }
    });

    // Agregar un evento cuando se selecciona un autor
    autoresSelect.addEventListener("change", function() {
        // Limpiar la lista antes de agregar los nuevos autores
        autoresSeleccionados.innerHTML = "";

        // Obtener los elementos seleccionados
        var selectedOptions = Array.from(autoresSelect.selectedOptions);

        // Agregar cada autor seleccionado a la lista
        selectedOptions.forEach(function(option) {
            var autor = document.createElement("li");
            autor.textContent = option.text;
            autoresSeleccionados.appendChild(autor);
        });
    });
});
</script>
@endsection
