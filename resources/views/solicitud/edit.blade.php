@extends('layouts.app')

@section('content')

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="container">
    <div class="col col-10">
        @if($solicitud->tipo === "Sobrecupo")
        <div class="form-group" id="groupTelefono">
            <label class="form-control-label">TELEFONO CONTACTO</label>
            <input id="telefono" type="text"
                class="form-control @error('telefono') is-invalid @enderror" name="telefono"
                value="{{ old('telefono') }}" placeholder="{{ $solicitud->telefono }}">

            @error('telefono')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group" id="groupNrc" >
            <label class="form-control-label">NRC ASIGNATURA</label>
            <input id="nrc" type="text" class="form-control @error('nrc') is-invalid @enderror"
                name="nrc" value="{{ old('nrc') }}" autocomplete="nrc" autofocus>

            @error('nrc')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group" id="groupNombre" >
            <label class="form-control-label">NOMBRE ASIGNATURA</label>
            <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror"
                name="nombre" value="{{ old('nombre') }}" autocomplete="nombre" autofocus>

            @error('nombre')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group" id="groupDetalles" >
            <label class="form-control-label">DETALLES DE LA SOLICITUD</label>
            <textarea id="detalle" type="text"
                class="form-control @error('detalle') is-invalid @enderror" name="detalle"
                value="{{ old('detalle') }}" autocomplete="detalle" autofocus></textarea>

            @error('detalle')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        @endif
    <div>
<div>
    @endsection
