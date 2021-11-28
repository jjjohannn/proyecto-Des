@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div>
            <div class="card">
                <div class="card-header">{{ __('Menu') }}</div>

                <div class="card-body">
                    <a class="text" href="">{{ __('Inicio') }}</a>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Información de la solicitud') }}</div>

                @include('alerta.flash-message')
                <div class="card-body">
                    <div class="form-group row">
                        <label for="fecha" class="col-md-4 text-md-right">{{ __('Fecha') }}</label>
                        <div>
                            <i class="text">{{ $solicitud->pivot->created_at }}</i>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="solicitud" class="col-md-4 text-md-right">{{ __('Solicitud') }}</label>
                        <div>
                            <i class="text">{{ $solicitud->pivot->id }}</i>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rut" class="col-md-4 text-md-right">{{ __('Rut') }}</label>
                        <div>
                            <i class="text">{{ $alumno->id }}</i>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nombre" class="col-md-4 text-md-right">{{ __('Nombre') }}</label>
                        <div>
                            <i class="text">{{ $alumno->name }}</i>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tipo" class="col-md-4 text-md-right">{{ __('Tipo') }}</label>
                        <div>
                            <i class="text">{{ $solicitud->tipo }}</i>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="correo" class="col-md-4 text-md-right">{{ __('Correo') }}</label>
                        <div>
                            <i class="text">{{ $alumno->email }}</i>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="telefono" class="col-md-4 text-md-right">{{ __('Telefono') }}</label>
                        <div>
                            <i class="text">{{ $solicitud->pivot->telefono }}</i>
                        </div>
                    </div>
                    <div class="row">
                        <label for="detalle" class="col-md-4 text-md-right">{{ __('Detalle') }}</label>
                        <div>
                            <textarea disabled id="detalle" type="text" class="form-control" name="detalle">{{ $solicitud->pivot->detalles }}</textarea>
                        </div>
                    </div>
                    <div class="row-md-4 text-md-center">
                        <a class="btn btn-success me-2" href="" role="button">Aceptar</a>
                        <a class="btn btn-primary me-2" href="" role="button">Aceptar con obs<i class="fas fa-download"></i></a>
                        <a class="btn btn-danger me-2"  href="" role="button">Rechazar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
