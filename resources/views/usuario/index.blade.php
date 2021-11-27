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

                        {{ __('Bienvenido') }} {{ auth()->user()->name }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@elseif (auth()->user()->rol == 1)

    <div class="container">
        <div class="row justify-content-center">

            <div>
                <div class="card">
                    <div class="card-header">{{ __('Menu') }}</div>

                    <div class="card-body">
                        <a class="text" href="{{ route('buscarEstudiante') }}">{{ __('Buscar') }}</a>
                    </div>

                    <div class="card-body">
                        <a class="text" href="{{ route('resolver') }}">{{ __('Resolver Solicitud') }}</a>
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

                        {{ __('Bienvenido') }} {{ auth()->user()->name }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@elseif (auth()->user()->rol == 2)

    <div class="container">
        <div class="row justify-content-center">

            <div>
                <div class="card">
                    <div class="card-header">{{ __('Menu') }}</div>

                    <div class="card-body">
                        <a class="text" href="{{ route('solicitud.index') }}">{{ __('Ver Solicitudes') }}</a>
                    </div>

                    <div class="card-body">
                        <a class="text" href="solicitud/create">{{ __('Generar Solicitud') }}</a>
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

                        {{ __('Bienvenido') }} {{ auth()->user()->name }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endif

@guest

    <p>Invitado</p>

@endguest

@endsection
