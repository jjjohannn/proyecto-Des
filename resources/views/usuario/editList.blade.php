@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div>
            <div class="card">
                <div class="card-header">{{ __('Menu') }}</div>

                <div class="card-body">
                    <a class="text" href="{{ route('index') }}">{{ __('Inicio') }}</a>
                </div>

                <div class="card-body">
                    <a class="text" href="{{ route('custom-registration') }}">{{ __('Registrar') }}</a>
                </div>

                <div class="card-body">
                    <a class="text" href="{{ route('usuario-editList')}}">{{ __('Editar') }}</a>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                @include('alerta.flash-message')
                <div class="card-body">
                    <div class="form-group row">
                        <label for="usuario" class="col-md-4 col-form-label text-md-right">{{ __('Lista de Usuarios') }}</label>


                        <form method="GET" action="{{ route('usuario-edit') }}">
                            @csrf
                            <select name="rut" required>
                                @foreach($users as $user)
                                    @if($user->rol == 1 or $user->rol == 2)
                                        <option value="{{ $user->rut }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <button>Change</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
