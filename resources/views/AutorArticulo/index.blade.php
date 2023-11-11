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
