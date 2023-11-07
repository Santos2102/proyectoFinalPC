@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
<section class="content container-fluid mt-4"> <!-- Agregamos la clase mt-4 para el espacio superior -->
    <div class="row">
        <div class="col-md-12">
            @includeif('partials.errors')

            <div class="card card-default">
                <div class="card-header">
                    <h5 class="card-title">{{ __('Crear nuevo') }}</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="/storeAutorarticulo" role="form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="idArticulo">Articulo</label>
                                    <select name="idArticulo" class="form-control" id="idArticulo" required>
                                        <option selected value=""></option>
                                        @foreach ($articulo as $item)
                                            <option value="{{ encrypt($item->idArticulo) }}">{{ $item->titulo }}</option>
                                        @endforeach
                                    </select>
                                    @error('idArticulo')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for "idAutor">Autor</label>
                                    <select name="idAutor" class="form-control" id="idAutor" required>
                                        <option selected value=""></option>
                                        @foreach ($autor as $item)
                                            <option value="{{ encrypt($item->idAutor) }}">{{ $item->nombre }} {{ $item->apellido }}</option>
                                        @endforeach
                                    </select>
                                    @error('idAutor')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fecha">Fecha</label>
                            <input type="date" name="fecha" id="fecha" value="{{ old('fecha') }}" required placeholder="Fecha" class="form-control">
                            @error('fecha')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="box-footer mt-4">
                            <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
