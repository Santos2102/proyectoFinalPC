@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <h5 class="card-title">Listado de Artículos</h5>
                    </div>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success mt-3">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>
                                    <th>Titulo</th>
                                    <th>Resumen</th>
                                    <th>Contenido</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($articulos as $articulo)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $articulo->titulo }}</td>
                                        <td>{{ $articulo->resumen }}</td>
                                        <td>{{ $articulo->contenido }}</td>

                                        <td>
                                            <form action="{{ route('deleteArticulo', encrypt($articulo->idArticulo)) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return eliminarArticulo('¿Desea eliminar este articulo?')"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No hay artículos disponibles.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
        function eliminarArticulo(value){
            action = confirm(value) ? true : event.preventDefault();
        }
    </script>
@endsection
