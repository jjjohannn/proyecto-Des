@extends('layouts.app')

@section('content')

@if(auth()->user()->rol == 0)
    <div class="container">
    <div class="row mb-3">
        <div class="col col-8">
            <p class="text-center" style="font-size: x-large">Gestión de carreras</p>
        </div>
        <div class="col col-2">
            <a class="btn btn-success btn-block" href="{{ route('agregarCarrera') }}"> <i class="fas fa-plus"></i> Agregar Carrera</a>
        </div>
    </div>
    <table class="table table-dark">
        <thead>
            <tr>
                <th style="width: 10%" scope="col">Código</th>
                <th style="width: 70%" scope="col">Nombre</th>
                <th style="width: 20%" scope="col" colspan="1">Accion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carreras as $carrera)
            <tr>
                <th scope="row">{{$carrera->codigo}}</th>
                <td>{{$carrera->nombre}}</td>
                <td><a class="btn btn-info" href={{ route('carreras.edit', [$carrera]) }}>editar</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    </div>

@elseif (auth()->user()->rol == 1)

    <p>eres jefe de carrera</p>

@elseif (auth()->user()->rol == 2)

    <p>Alumno</p>

@endif



@endsection
