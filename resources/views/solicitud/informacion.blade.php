@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div>
            <div class="col col-1">
                <div class="row justify-content-center">
                    <a class="btn btn-secondary" href="{{ route('resolver') }}" class="btn btn-secondary">Atras</a>
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
                            <i class="text">{{ $alumno->rut }}</i>
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
                            <i class="text">{{ __('+569') }}</i>
                            <i class="text">{{ $solicitud->pivot->telefono }}</i>
                        </div>
                    </div>
                    <div class="row">
                        <label for="detalle" class="col-md-4 text-md-right">{{ __('Detalle') }}</label>
                        <div>
                            <textarea disabled id="detalle" type="text" class="form-control" name="detalle">{{ $solicitud->pivot->detalles }}</textarea>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('resolverSolicitud.update', [$solicitud]) }}">
                        @csrf
                        @method('PUT')
                        <input id="value" type="text" class="form-control" name="value" value="1" hidden>
                        <input id="solicitud" type="text" class="form-control" name="solicitud" value="{{ $solicitud->pivot->id }}" hidden>
                        <input id="alumno" type="text" class="form-control" name="alumno" value="{{ $alumno->id }}" hidden>

                        <hr noshade="noshade" size="2" width="100%">
                        <button type="submit" class="btn btn-success me-2">
                            {{ __('Aceptar') }}
                        </button>
                    </form>
                    <form method="POST" action="{{ route('resolverSolicitud.update', [$solicitud]) }}">
                        @csrf
                        @method('PUT')
                        <input id="value" type="text" class="form-control" name="value" value="2" hidden>
                        <input id="solicitud" type="text" class="form-control" name="solicitud" value="{{ $solicitud->pivot->id }}" hidden>
                        <input id="alumno" type="text" class="form-control" name="alumno" value="{{ $alumno->id }}" hidden>

                        <button type="submit" class="btn btn-primary me-2" style= "margin: -62px 50px 0 35%">
                            {{ __('Aceptar con obs') }}
                        </button>
                    </form>
                    <form method="POST" action="{{ route('resolverSolicitud.update', [$solicitud]) }}">
                        @csrf
                        @method('PUT')
                        <input id="value" type="text" class="form-control" name="value" value="3" hidden>
                        <input id="solicitud" type="text" class="form-control" name="solicitud" value="{{ $solicitud->pivot->id }}" hidden>
                        <input id="alumno" type="text" class="form-control" name="alumno" value="{{ $alumno->id }}" hidden>

                        <button type="submit" class="btn btn-danger me-2" style= "margin: -110px 50px 0 88%">
                            {{ __('Rechazar') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
