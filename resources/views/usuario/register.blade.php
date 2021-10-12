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
                    <form method="POST" action="{{ route('register.custom') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="rut" type="text" class="form-control @error('rut') is-invalid @enderror" name="rut" value="{{ old('rut') }}" required autocomplete="rut">

                                @error('rut')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                            <div class="col-md-6">
                                <input id="status" type="checkbox" class="form-control @error('status') is-invalid @enderror" name="status">

                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rol" class="col-md-4 col-form-label text-md-right">{{ __('Rol') }}</label>

                            <div class="col-md-6">
                                <!--<input id="rol" type="text" class="form-control @error('rol') is-invalid @enderror" name="rol" value="{{ old('rol') }}" required autocomplete="rol">

                                @error('rol')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror-->

                                <select id="rol" name="rol" required>
                                    <option value="">Seleccione</option>
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

                    <!--Esto aqui abajo se encarga de desplegar la lista de carreras en el registrar usuario
                        recibe por parametro las carreras como $carreras para poder desplegar
                        todas las carreras existentes en la base de datos y poder seleccionar una,
                        esta seccion despliega los nombres pero devuelve el id de la carrera a la ruta.
                    -->

                        <div class="form-group row">
                            <label for="carrera" class="col-md-4 col-form-label text-md-right">{{ __('Carrera') }}</label>

                            <form method="GET" action="{{ route('gestionCarrera') }}">

                                <select id="carrera" name="carrera" >
                                    <option value="">Seleccionar carrera</option>

                                    @foreach ($carreras as $carrera)
                                        <option value="{{ $carrera->id}}">{{ $carrera->nombre}}</option>
                                    @endforeach
                                </select>


                            </div>

                        <!--<div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>-->

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Esta seccion contiene los scripts de la pagina principal-->
<script>
    /*Esta primera parte se encarga de desplegar el mensaje de error cuando se intenta crear un usuario
        y no hay carreras en el sistema
        @param rolUsuario, esta variable obtiene el rol del usuario que se esta registrando, sirve para la segunda parte
        @param cuadroCarreras, esta variable recibe las carreras y sirve para la segunda parte
        @param listaCarreras, esta variable guarda las carreras que hay en la base, lo usamos para poder ver cuantas
        carreras hay en el sistema, si hay 0 despliega el mensaje de error y redirecciona a dos opciones
    */
    const rolUsuario = document.getElementById('rol');
    const cuadroCarreras = document.getElementById('carrera')
    const listaCarreras = {!! json_encode($carreras) !!}
    if (listaCarreras.length === 0) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'No puedes crear usuarios sin tener carreras en el sistema!!!',
            footer: 'Para crear carreras has&nbsp;<a href="/carreras">click aca</a>'
        }).then((result) => {
            window.location.href = '/index'
        })
    }
    /*Aqui empieza la segunda parte, se encarga de bloquear el cuadro de carreras cuando
    se selecciona la opcion Jefe de carrera

        @param rolUsuario, aqui se usa rolUsuario para saber si es un jefe o un estudiante y almacena 1 o 2
        @param cuadroCarreras, esta variable cambia entre true y false para habilitar o deshabilitar el cuadro
        para que cuando el rol sea 1 (o sea el jefe de carrera) el cuadro no deje seleccionar carreras ya que el jefe
        no posee no selecciona una carrera

    rolUsuario.addEventListener('change', function(e){
            if (rolUsuario.value === '1') {
            cuadroCarreras.value = null;
            cuadroCarreras.disabled = true;
            }else{
                cuadroCarreras.disabled = false;
            }
        })
         */
</script>

@endsection
