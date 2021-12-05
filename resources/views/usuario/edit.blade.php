@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div>
            <div class="card">
                <div class="card-header">{{ __('Menú') }}</div>

                <div class="card-body">
                    <a class="text" href="{{ route('usuario.index') }}">{{ __('Inicio') }}</a>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editor') }}</div>

                @include('alerta.flash-message')
                <div class="card-body">
                    <form method="POST" action="{{ route('usuario.update', [$user]) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">

                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autofocus placeholder="{{ $user->name }}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ $user->email }}">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rut" class="col-md-4 col-form-label text-md-right">{{ __('Rut') }}</label>

                            <div class="col-md-6">
                                <input id="rut" type="text" class="form-control @error('rut') is-invalid @enderror" name="rut" value="{{ old('rut') }}" placeholder="{{ $user->rut }}">

                                @error('rut')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @if(!$user->rol == 0)
                        <div class="form-group row">
                            <label for="rol" class="col-md-4 col-form-label text-md-right">{{ __('Rol actual') }}</label>

                            <div class="col-md-6">

                                @if($user->rol ==  1)

                                <input type="text" class="form" value="{{ old('rol') }}" placeholder="Jefe de carrera" disabled>

                                @else

                                <input type="text" class="form" value="{{ old('rol') }}" placeholder="Estudiante" disabled>

                                @endif

                                <select id="rol" name="rol">
                                    <option value="">Seleccione Rol</option>
                                    <option value="1">Jefe de Carrera</option>
                                    <option value="2">Estudiante</option>
                                </select>

                                @error('rol')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="carrera_id" class="col-md-4 col-form-label text-md-right">{{ __('Carrera actual') }}</label>

                                <input type="text" class="form" placeholder={{ $user->carrera->nombre }} disabled>


                                <select id="carrera_id" name="carrera_id" style="width: 150px;">

                                    <option value="">Seleccionar carrera</option>

                                    @foreach ($carreras as $carrera)
                                        <option value="{{ $carrera->id }}">{{ $carrera->nombre }} ({{$carrera->codigo}})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif

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

<script>
    const rolSelect = {!! json_encode($user->rol) !!}
            const carreraSelect = document.getElementById('carrera_id')
            const optionSelect = document.getElementById("carrera_id").getElementsByTagName("option");
            const listaCarreras = {!! json_encode($carreras) !!}
            console.log(listaCarreras);
            if (listaCarreras.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'No puedes crear usuarios sin tener carreras en el sistema!',
                    footer: 'Para crear carreras has&nbsp;<a href="/carrera/create">click aca</a>'
                }).then((result) => {
                    window.location.href = '/usuario'
                })
            }
            if (rolSelect == 1) {
                    listaCarreras.forEach(carrera => {
                        carrera.users.forEach(user => {
                            if (user.rol == 1) {
                                for (let i = 0; i < optionSelect.length; i++) {
                                    if (carrera.id == optionSelect[i].value) {
                                        optionSelect[i].style.display = "none"
                                    }
                                }
                            }
                        });
                    });
                } else {
                    listaCarreras.forEach(carrera => {
                        carrera.users.forEach(user => {
                            for (let i = 0; i < optionSelect.length; i++) {
                                if (carrera.id == optionSelect[i].value) {
                                    optionSelect[i].style.display = "unset"
                                }
                            }
                        });
                    });
                }
</script>
@endsection
