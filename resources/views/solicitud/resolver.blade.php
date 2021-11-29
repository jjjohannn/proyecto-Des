@extends('layouts.app')

@section('content')

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="container">
    <div class="row mb-4">
        <div class="col col-3">
            <!--<form class="form-inline my-2 my-lg-0" method="GET" action="">
                <input class="form-control mr-sm-2" name="search" id="search" type="search"
                    placeholder="Buscar por código" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i>Ir</button>
            </form>-->
        </div>
        <div class="col col-7">
            <p class="text-center" style="font-size: x-large">Solicitudes Pendientes</p>
        </div>
    </div>

    <div class="row">
        <div class="col col-1">
            <div class="row justify-content-center">
                <a class="btn btn-secondary" href="{{ route('usuario.index') }}" class="btn btn-secondary">Atras</a>
            </div>
        </div>

        <div>
            <div class="card">
                <div class="card-header">{{ __('Menu') }}</div>

                <div class="card-body row justify-content-center">
                    <a class="text" href="">Aceptada</a>
                </div>
                <div class="card-body row justify-content-center">
                    <a class="text" href="">Anulada</a>
                </div>
                <div class="card-body row justify-content-center">
                    <a class="text" href="">Rechazada</a>
                </div>
                <div class="card-body row justify-content-center">
                    <a class="text" href="">Aceptada con observación</a>
                </div>
            </div>
        </div>

        <div class="col col-9">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="width: 15%" scope="col">Fecha y hora</th>
                        <th style="width: 20%" scope="col">Numero Solicitud</th>
                        <th style="width: 30%" scope="col">Rut Estudiante</th>
                        <th style="width: 20%" scope="col">Nombre estudiante</th>
                        <th style="width: 10%" scope="col">Tipo</th>
                        <th style="width: 10%" scope="col">Resolver</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>

                    @forelse ($alumnos as $alumno)
                        @if ($alumno->carrera_id == Auth::user()->carrera_id)
                            @foreach ($alumno->solicitudes as $solicitud)
                                @if ($solicitud->pivot->estado == 0)
                                    <tr>
                                        <td>{{ $solicitud->pivot->created_at }}</td>
                                        <td>{{ $solicitud->pivot->id }}</td>
                                        <td>{{ $alumno->rut }}</td>
                                        <td>{{ $alumno->name }}</td>
                                        <td>{{ $solicitud->tipo }}</td>
                                        <td><a class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Ir" href={{ route('informacion', ['idSolicitud'=>$solicitud->getOriginal()['pivot_id'], 'idAlumno'=>$alumno->getOriginal()['id']])}}><i class="far fa-edit"></i>Ir</a></td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            <p>No hay solicitudes por resolver</p>
                        </td>
                    </tr>
                    @endforelse
                    @if ($aux == 0)
                        <td colspan="4">
                            <p>No hay solicitudes por resolver</p>
                        </td>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
