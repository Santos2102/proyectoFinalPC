@extends('layouts.app')

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="float-right">
                    <a href="{{ route('crearAutorArticulo') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                        {{ __('Nuevo') }}
                    </a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('filtrarFechas') }}" role="form" enctype="multipart/form-data">
                        @csrf
                        <div class="box box-info padding-1">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="start_date">Fecha inicio</label>
                                    <input type="date" name="start_date" id="start_date" required placeholder="Fecha de inicio" class="form-control">
                                    @error('start_date')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="end_date">Fecha final</label>
                                    <input type="date" name="end_date" id="end_date" required placeholder="Fecha final" class="form-control">
                                    @error('end_date')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="box-footer mt20">
                                <button type="submit" class="btn btn-primary">{{ __('Verificar') }}</button>
                            </div>
                        </div>
                    </form>

                    @if(isset($autorArticulos))
                        <h2>Datos Filtrados</h2>
                        <table class="table   text-center">
                            <thead>
                                <tr>
                                    <th>Articulo</th>
                                    <th>Autor</th>
                                    <th>Fecha</th>
                                    <!-- Agrega aquí las columnas que deseas mostrar -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($autorArticulos as $data)
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
    </section>
@endsection
