@extends('layouts.app')

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
                    <form method="POST" action="{{ route('filtrarFechas') }}"  role="form" enctype="multipart/form-data">
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
                                    <input type="date" name="end_date" id="end_date" required placeholder="Fecgha final" class="form-control">
                                    @error('lastname')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="box-footer mt20">
                                <button type="submit" class="btn btn-primary">{{ __('Verificar') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
