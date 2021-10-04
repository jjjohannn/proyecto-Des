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
                        <a class="text" id="register" href="{{ route('custom-registration') }}">{{ __('Registrar') }}</a>
                    </div>

                    <div class="card-body">
                        <a class="text" href="{{ route('usuario.editList') }}">{{ __('Editar') }}</a>
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

            @if(!empty($users))
                <input id="noUsers" type="hidden">
            @endif

        </div>
    </div>

    <script>
        const button = document.getElementById('register');
        const noUsers = document.getElementById('noUsers');
        if(noUsers == null){
            button.addEventListener('click', function(e){
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                })
            })
        }
    </script>

@elseif (auth()->user()->rol == 1)

    <p>eres jefe de carrera</p>

@elseif (auth()->user()->rol == 2)

    <p>Alumno</p>

@endif

@endsection
