@extends('layouts.app')

@section('content')

@if(auth()->user()->rol == 0)

    <div class="container">
        <div class="row justify-content-center">

            <div>
                <div class="card">
                    <div class="card-header">{{ __('Menu') }}</div>

                    <div class="card-body">
                        <a class="text" href="{{ route('usuario.index') }}">{{ __('Inicio') }}</a>
                    </div>

                    <div class="card-body">
                        <a class="text"  href="{{ route('custom-registration') }}">{{ __('Registrar') }}</a>
                    </div>

                    <div class="card-body">
                        <a class="text" href="{{ route('gestionCarrera') }}">{{ __('Gestionar Carreras') }}</a>
                    </div>

                    <div class="card-body">
                        <a class="text" href=" {{ route('usuario.editList') }} ">{{ __('Editar') }}</a>
                    </div>

                    <div class="card-body">
                        <a class="text" href=" {{ route('cargaMasiva') }} ">{{ __('Carga Masiva') }}</a>
                    </div>

                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('Admin') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
    </div>



@elseif (auth()->user()->rol == 1)

    <p>eres jefe de carrera</p>
    <img src="{{url('/Images\WoP.png')}}" alt="Image" />

@elseif (auth()->user()->rol == 2)

    <p>Alumno</p>
    <img src="{{url('/Images\WoP.png')}}" alt="Image" />

@endif

@guest

    <p>Invitado</p>

@endguest

@endsection
