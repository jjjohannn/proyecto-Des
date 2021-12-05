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
            <p class="text-center" style="font-size: x-large">Solicitudes</p>
        </div>
    </div>

    <div class="row">
        <div class="col col-1">
            <div class="row justify-content-center">
                <a class="btn btn-secondary" href="{{ route('usuario.index') }}" class="btn btn-secondary">Atrás</a>
            </div>
        </div>

        <div class="col col-9">
            <section id="tabs" class="project-tab">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <nav>
                                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Pendiente</a>
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Aceptado</a>
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Aceptado con Observación</a>
                                    <a class="nav-item nav-link" id="nav-settings-tab" data-toggle="tab" href="#nav-settings" role="tab" aria-controls="nav-settings" aria-selected="false">Rechazados</a>
                                    <a class="nav-item nav-link" id="nav-a-tab" data-toggle="tab" href="#nav-a" role="tab" aria-controls="nav-a" aria-selected="false">Negadas</a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">

                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    @if ($aux_Pendiente > 0)
                                    <table class="table" cellspacing="0">
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
                                                    @foreach ($alumno->solicitudes as $solicitud)
                                                        @if ($solicitud->pivot->estado == 0 and $alumno->carrera_id == Auth::user()->carrera_id)
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
                                                @empty

                                                @endforelse
                                            </tr>
                                        </tbody>
                                    </table>
                                    @else
                                    <p>No hay solicitudes por resolver</p>
                                    @endif
                                </div>


                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    @if ($aux_Aceptada > 0)
                                    <table class="table" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th style="width: 15%" scope="col">Fecha y hora</th>
                                                <th style="width: 20%" scope="col">Número Solicitud</th>
                                                <th style="width: 30%" scope="col">Rut Estudiante</th>
                                                <th style="width: 20%" scope="col">Nombre estudiante</th>
                                                <th style="width: 10%" scope="col">Tipo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @forelse ($alumnos as $alumno)
                                                    @foreach ($alumno->solicitudes as $solicitud)
                                                        @if ($solicitud->pivot->estado == 1 and $alumno->carrera_id == Auth::user()->carrera_id)
                                                            <tr>
                                                                <td>{{ $solicitud->pivot->created_at }}</td>
                                                                <td>{{ $solicitud->pivot->id }}</td>
                                                                <td>{{ $alumno->rut }}</td>
                                                                <td>{{ $alumno->name }}</td>
                                                                <td>{{ $solicitud->tipo }}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @empty

                                                @endforelse
                                            </tr>
                                            </tr>
                                        </tbody>
                                    </table>
                                    @else
                                    <p>No hay solicitudes por resolver</p>
                                    @endif
                                </div>

                                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                    @if ($aux_Observacion > 0)
                                    <table class="table" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th style="width: 15%" scope="col">Fecha y hora</th>
                                                <th style="width: 20%" scope="col">Número Solicitud</th>
                                                <th style="width: 30%" scope="col">Rut Estudiante</th>
                                                <th style="width: 20%" scope="col">Nombre estudiante</th>
                                                <th style="width: 10%" scope="col">Tipo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @forelse ($alumnos as $alumno)
                                                    @foreach ($alumno->solicitudes as $solicitud)
                                                        @if ($solicitud->pivot->estado == 2 and $alumno->carrera_id == Auth::user()->carrera_id)
                                                            <tr>
                                                                <td>{{ $solicitud->pivot->created_at }}</td>
                                                                <td>{{ $solicitud->pivot->id }}</td>
                                                                <td>{{ $alumno->rut }}</td>
                                                                <td>{{ $alumno->name }}</td>
                                                                <td>{{ $solicitud->tipo }}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @empty

                                                @endforelse
                                            </tr>
                                        </tbody>
                                    </table>
                                    @else
                                    <p>No hay solicitudes por resolver</p>
                                    @endif
                                </div>

                                <div class="tab-pane fade" id="nav-settings" role="tabpanel" aria-labelledby="nav-settings-tab">
                                    @if ($aux_Rechazada > 0)
                                    <table class="table" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th style="width: 15%" scope="col">Fecha y hora</th>
                                                <th style="width: 20%" scope="col">Número Solicitud</th>
                                                <th style="width: 30%" scope="col">Rut Estudiante</th>
                                                <th style="width: 20%" scope="col">Nombre estudiante</th>
                                                <th style="width: 10%" scope="col">Tipo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @forelse ($alumnos as $alumno)
                                                    @foreach ($alumno->solicitudes as $solicitud)
                                                        @if ($solicitud->pivot->estado == 3 and $alumno->carrera_id == Auth::user()->carrera_id)
                                                            <tr>
                                                                <td>{{ $solicitud->pivot->created_at }}</td>
                                                                <td>{{ $solicitud->pivot->id }}</td>
                                                                <td>{{ $alumno->rut }}</td>
                                                                <td>{{ $alumno->name }}</td>
                                                                <td>{{ $solicitud->tipo }}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @empty

                                                @endforelse
                                            </tr>
                                        </tbody>
                                    </table>
                                    @else
                                    <p>No hay solicitudes por resolver</p>
                                    @endif
                                </div>

                                <div class="tab-pane fade" id="nav-a" role="tabpanel" aria-labelledby="nav-a-tab">
                                    @if ($aux_Negada > 0)

                                    <table class="table" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th style="width: 15%" scope="col">Fecha y hora</th>
                                                <th style="width: 20%" scope="col">Número Solicitud</th>
                                                <th style="width: 30%" scope="col">Rut Estudiante</th>
                                                <th style="width: 20%" scope="col">Nombre estudiante</th>
                                                <th style="width: 10%" scope="col">Tipo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($alumnos as $alumno)
                                            @if ($alumno->carrera_id == Auth::user()->carrera_id)
                                                @foreach ($alumno->solicitudes as $solicitud)
                                                    @if ($solicitud->pivot->estado == 4 and $alumno->carrera_id == Auth::user()->carrera_id)
                                                        <tr>
                                                            <td>{{ $solicitud->pivot->created_at }}</td>
                                                            <td>{{ $solicitud->pivot->id }}</td>
                                                            <td>{{ $alumno->rut }}</td>
                                                            <td>{{ $alumno->name }}</td>
                                                            <td>{{ $solicitud->tipo }}</td>
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
                                        </tbody>
                                    </table>
                                    @else
                                    <p>No hay solicitudes por resolver</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection
