@extends('layouts.app')

@section('content')
<section class="content container-fluid mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-right">
                        <a href="{{ route('crearAutorArticulo') }}" class="btn btn-primary btn-sm">
                            {{ __('Nuevo') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('filtrarFechas') }}" role="form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start_date">Fecha inicio</label>
                                    <input type="date" name="start_date" id="start_date" required class="form-control">
                                    @error('start_date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end_date">Fecha final</label>
                                    <input type="date" name="end_date" id="end_date" required class="form-control">
                                    @error('end_date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary">{{ __('Verificar') }}</button>
                        </div>
                    </form>

                    @if (isset($autorArticulos))
                        <h2 class="mt-4">Datos Filtrados</h2>
                        <table class="table table-striped text-center">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Autor</th>
                                    <th>Fecha</th>
                                    <!-- Agrega aquí las columnas que deseas mostrar -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($autorArticulos as $data)
                                    <tr>
                                        <td>{{ $data->idArticulo }}</td>
                                        <td>{{ $data->idAutor }}</td>
                                        <td>{{ $data->fecha }}</td>
                                        <!-- Agrega aquí las columnas que deseas mostrar -->
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
