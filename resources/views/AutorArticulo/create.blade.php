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

                    <div class="form-group">
                        <label>Autores Seleccionados:</label>
                        <ul id="autoresSeleccionados"></ul>
                    </div>

                    <script>
                        var selectAutores = document.getElementById('autores');
                        var ulAutoresSeleccionados = document.getElementById('autoresSeleccionados');

                        selectAutores.addEventListener('change', function () {
                            ulAutoresSeleccionados.innerHTML = '';

                            var selectedOptions = selectAutores.selectedOptions;
                            for (var i = 0; i < selectedOptions.length; i++) {
                                var option = selectedOptions[i];
                                var li = document.createElement('li');
                                li.textContent = option.textContent;
                                ulAutoresSeleccionados.appendChild(li);
                            }
                        });
                    </script>


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
                            <?php
                                date_default_timezone_set('America/Guatemala');
                                $fechaActual = \Carbon\Carbon::now()->toDateString();
                            ?>
                            <input type="date" name="fecha" id="fecha" value="{{ old('fecha', $fechaActual) }}" required placeholder="Fecha" class="form-control">
                            @error('fecha')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>




                        <div class="box-footer mt-4">
                            <button type="button" class="btn btn-primary" onclick="confirmGuardar()">{{ __('Guardar') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function confirmGuardar() {
    var confirmacion = confirm("¿Desea guardar los datos?");
    if (confirmacion) {
        document.forms[0].submit();
    }
}
</script>
@endsection
