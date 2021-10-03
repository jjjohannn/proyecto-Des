@extends('layouts.app')

@section('content')

<div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 login-title">
                    EDITAR CARRERA</div>
                </div>

                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <form id="formulario" method="POST" action="{{ route('actualizarCarrera', [$carrera]) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="form-control-label">NOMBRE</label>
                                <input value="{{$carrera->nombre}}" id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror"
                                name="nombre" required>

                                @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-lg-12 py-3">
                                <div class="col-lg-12 text-center">
                                    <button type="submit" id="boton" class="btn btn-outline-primary">{{ __('Editar carrera') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div>

@endsection
