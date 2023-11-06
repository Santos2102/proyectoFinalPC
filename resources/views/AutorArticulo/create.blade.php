@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">

            @includeif('partials.errors')

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">{{ __('Crear') }} nuevo</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="/storeAutorarticulo"  role="form" enctype="multipart/form-data">
                        @csrf
                        <div class="box box-info padding-1">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="idArticulo">Articulo</label>
                                    <select name="idArticulo" class="form-control text-dark" id="idArticulo" required>
                                        <option selected value=""></option>
                                        @foreach ($articulo as $item)
                                            <option value="{{encrypt($item->idArticulo)}}">{{$item->titulo}}</option>
                                        @endforeach
                                    </select>
                                    @error('idArticulo')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="idAutor">Autor</label>
                                    <select name="idAutor" class="form-control text-dark" id="idAutor" required>
                                        <option selected value=""></option>
                                        @foreach ($autor as $item)
                                            <option value="{{encrypt($item->idAutor)}}">{{$item->nombre}}</option>
                                        @endforeach
                                    </select>
                                    @error('idAutor')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                        <label for="fecha">Fecha</label>
                                        <input type="date" name="fecha" id="fecha" value="{{old('fecha')}}" required placeholder="Fecha" class="form-control">
                                        @error('fecha')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                            <div class="box-footer mt20">
                                <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection