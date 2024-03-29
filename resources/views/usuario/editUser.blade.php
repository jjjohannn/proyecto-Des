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

        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                @include('alerta.flash-message')
                <div class="card-body">
                    <div class="form-group row">
                        <label for="usuario" class="col-md-4 col-form-label text-md-right">{{ __('Lista de Usuarios') }}</label>

                        <form method="GET" action="{{ route('usuario.lista') }}">
                            <input type="text" name="search" id="search" placeholder="Buscar por Rut">
                            <button class="btn btn-success">Buscar</button>
                        </form>
                    </div>
                    </div>
                    <table class="table table-white">
                        <thead>
                            <tr>
                                <th style="width: 10%" scope="col">Rut</th>
                                <th style="width: 25%" scope="col">Nombre</th>
                                <th style="width: 25%" scope="col">Email</th>
                                <th style="width: 20%" scope="col">Rol</th>
                                <th style="width: 20%" scope="col" colspan="3">Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $usuario)
                            <tr>
                                <th scope="row">{{$usuario->rut}}</th>
                                <td>{{$usuario->name}}</td>
                                <td>{{$usuario->email}}</td>
                                @if($usuario->rol === 2)
                                    <td>Estudiante</td>
                                @elseif($usuario->rol === 1)
                                    <td>Jefe De Carrera</td>
                                @else
                                     <td>Administrador</td>
                                @endif

                                <td><a class="btn btn-info" href={{ route('usuario.edit', [$usuario]) }}>Editar</a></td>
                                    @if($usuario->rol !== 0)
                                        @if ($usuario->status === 1)
                                            <td><a class="btn btn-warning" href={{ route('usuario.cambiarStatus', ['id' => $usuario]) }}>Deshabilitar</a></td>
                                        @else
                                            <td><a class="btn btn-info" href={{ route('usuario.cambiarStatus', ['id' => $usuario]) }}>Habilitar</a></td>
                                        @endif
                                    @else
                                        <td><a class="btn btn-warning disabled" > Deshabilitar</a></td>
                                    @endif
                                <td><a class="btn btn-danger" href={{ route('usuario.reinicioContr', ['id' => $usuario]) }}>Reiniciar Clave</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
