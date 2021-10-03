@extends('layouts.app')

@section('content')

@if(auth()->user()->rol == 0)
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 login-title">
                    CREAR CARRERA
                </div>

                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <form id="formulario" method="POST" action="{{ route('guardarCarrera') }}">
                            @csrf
                            <div class="form-group">
                                <label class="form-control-label">CÓDIGO</label>
                                <input id="codigo" type="text" class="form-control @error('codigo') is-invalid @enderror"
                                    name="codigo" value="{{ old('codigo') }}" required autocomplete="codigo" autofocus>

                                @error('codigo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">NOMBRE</label>
                                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror"
                                    name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>

                                @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-lg-12 py-3">
                                <div class="col-lg-12 text-center">
                                    <button type="submit" id="boton" class="btn btn-outline-primary">{{ __('Agregar') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div>




@elseif (auth()->user()->rol == 1)

    <p>eres jefe de carrera</p>

@elseif (auth()->user()->rol == 2)

    <p>Alumno</p>

@endif






@endsection
