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
                    <a class="text" href="{{ route('editList')}}">{{ __('Editar') }}</a>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                @include('alerta.flash-message')
                <div class="card-body">
                    <form method="POST" action="">
                        @csrf

                        <div class="form-group row">
                            <label for="alumno" class="col-md-4 col-form-label text-md-right">{{ __('Lista de Alumnos') }}</label>

                            <div class="col-md-6">

                                <select id="rut" name="rut" required>

                                    @foreach($users as $user)
                                        @if($user->rol == 1 or $user->rol == 2)
                                            <option value="{{ $user->rut }}">{{ $user->name }}</option>
                                        @endif
                                    @endforeach

                                </select>

                                @error('alumno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Aceptar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
