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
            <form class="form-inline my-2 my-lg-0" method="GET" action="">
                <input class="form-control mr-sm-2" name="search" id="search" type="search"
                    placeholder="Buscar por código" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i>Ir</button>
            </form>
        </div>
        <div class="col col-7">
            <p class="text-center" style="font-size: x-large">Mis Solicitudes</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col col-1">
            <div class="row justify-content-center">
                <a class="btn btn-secondary" href="{{ route('usuario.index') }}" class="btn btn-secondary">Atras</a>
            </div>
        </div>

        <div class="col col-10">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="width: 15%" scope="col">Fecha y hora</th>
                        <th style="width: 20%" scope="col">Numero Solicitud</th>
                        <th style="width: 30%" scope="col">Rut Estudiante</th>
                        <th style="width: 20%" scope="col">Nombre estudiante</th>
                        <th style="width: 10%" scope="col">Tipo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>

                    @forelse ($alumnos as $alumno)
                        @foreach ($alumno->solicitudes as $solicitud)
                            <tr>
                                <td>{{ $solicitud->pivot->created_at }}</td>
                                <td>{{ $solicitud->pivot->id }}</td>
                                <td>{{ $alumno->rut }}</td>
                                <td>{{ $alumno->name }}</td>
                                <td>{{ $solicitud->tipo }}</td>
                            </tr>
                        @endforeach
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            <p>Sin Solicitudes</p>
                        </td>
                    </tr>

                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
