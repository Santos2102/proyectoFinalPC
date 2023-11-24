@extends('layouts.app')

@section('content')
<section class="content container-fluid mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{ __('Listado de articulos') }}</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('filtrarFechas') }}" role="form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start_date">Fecha de Inicio</label>
                                    <?php
                                        date_default_timezone_set('America/Guatemala');
                                        $fechaActual = \Carbon\Carbon::now()->toDateString();
                                    ?>
                                    <input type="date" name="start_date" id="start_date" required class="form-control" value="{{ old('start_date', $fechaActual) }}">
                                    @error('start_date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end_date">Fecha Final</label>
                                    <input type="date" name="end_date" id="end_date" required class="form-control" value="{{ old('end_date', $fechaActual) }}">
                                    @error('end_date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary">{{ __('Verificar') }}</button>
                        </div>
                    </form>

                    @if (isset($autorArticulos))
                        <table class="table table-striped text-center ">
                            <thead>
                                <tr>
                                    <th>Autor</th>
                                    <th>Articulo</th>
                                    <th>Resumen</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($autorArticulos as $data)
                                    <tr>
                                        <td>{{ $data->autor->nombre }} {{$data->autor->apellido}}</td>
                                        <td>{{ $data->articulo->titulo }}</td>
                                        <td>{{ $data->articulo->resumen}}</td>
                                        <td>{{ Carbon\Carbon::parse($data->fecha)->format('d-m-Y') }}</td>
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
@endsection
