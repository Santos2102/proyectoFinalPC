@extends('layouts.app')

@section('content')
<section class="content container-fluid mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{ __('Listado de artículos') }}</h5>
                </div>
                <div class="card-body">
                    <div id="myFormWrapper">
                        <form method="POST" action="{{ route('examenFinalWeb') }}" role="form" enctype="multipart/form-data" id="myForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="idAutor">Selecciona un autor:</label>
                                        <select name="idAutor" id="idAutor" class="form-control" required>
                                            @foreach ($autor as $item)
                                                <option value="{{ encrypt($item->idAutor) }}">{{ $item->nombre }} {{ $item->apellido }}</option>
                                            @endforeach
                                        </select>
                                        @error('idAutor')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="activo">Estado del artículo:</label>
                                        <select name="activo" id="activo" class="form-control">
                                            <option value="1">Activo</option>
                                            <option value="0">Inactivo</option>
                                        </select>
                                        @error('activo')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_date">Fecha de Inicio:</label>
                                        <?php
                                            date_default_timezone_set('America/Guatemala');
                                            $fechaActual = \Carbon\Carbon::now()->toDateString();
                                        ?>
                                        <input type="date" name="start_date" id="start_date" required class="form-control" value="{{ old('start_date',$fechaActual) }}">
                                        @error('start_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="end_date">Fecha Final:</label>
                                        <input type="date" name="end_date" id="end_date" required class="form-control" value="{{ old('end_date', $fechaActual) }}">
                                        @error('end_date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <button type="button" onclick="submitForm()" class="btn btn-primary">{{ __('Verificar') }}</button>
                            </div>
                        </form>
                    </div>

                    @if (isset($autorArticulos))
                        <table class="table table-striped text-center">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Titulo</th>
                                    <th>Resumen</th>
                                    <th>Contenido</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($autorArticulos as $data)
                                    <tr>
                                        <td>{{ Carbon\Carbon::parse($data->fecha)->format('d-m-Y') }}</td>
                                        <td>{{ $data->articulo->titulo }}</td>
                                        <td>{{ $data->articulo->resumen }}</td>
                                        <td>{{ $data->articulo->contenido }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function submitForm() {
        document.getElementById('myForm').submit();
    }
</script>
@endsection
