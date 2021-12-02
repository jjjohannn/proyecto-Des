@extends('layouts.app')

@section('content')

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="container">
        <div class="col col-10">
            <div class="col-lg-12 login-form">
                <div class="col-lg-12 login-form">
                    <form method="POST" action="{{ route('solicitud.update', [$solicitud->pivot->id]) }}">
                        @csrf
                        @method('PUT')

                        @if($solicitud->getOriginal()['tipo']==="Sobrecupo" || $solicitud->getOriginal()['tipo']==="Cambio Paralelo"
                        || $solicitud->getOriginal()['tipo']==="Eliminación Asignatura" || $solicitud->getOriginal()['tipo']==="Inscripción Asignatura")
                        <div class="form-group" id="groupTelefono" >
                            <label class="form-control-label">TELEFONO CONTACTO</label>
                            <input id="telefono" type="text"
                                class="form-control @error('telefono') is-invalid @enderror" name="telefono"
                                value="{{ old('telefono') }}" autofocus placeholder="{{ $solicitud->getOriginal()['pivot_telefono'] }}">

                            @error('telefono')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group" id="groupNrc">
                            <label class="form-control-label">NRC ASIGNATURA</label>
                            <input id="nrc" type="text" class="form-control @error('nrc') is-invalid @enderror"
                                name="nrc" value="{{ old('nrc') }}" autofocus placeholder="{{ $solicitud->getOriginal()['pivot_NRC'] }}"s>

                            @error('nrc')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group" id="groupNombre">
                            <label class="form-control-label">NOMBRE ASIGNATURA</label>
                            <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror"
                                name="nombre" value="{{ old('nombre') }}" autofocus placeholder="{{ $solicitud->getOriginal()['pivot_nombre_asignatura'] }}">

                            @error('nombre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group" id="groupDetalles">
                            <label class="form-control-label">DETALLES DE LA SOLICITUD</label>
                            <textarea id="detalle" type="text"
                                class="form-control @error('detalle') is-invalid @enderror" name="detalle"
                                value="{{ old('detalle') }}" autofocus placeholder="{{ $solicitud->getOriginal()['pivot_detalles'] }}"></textarea>

                            @error('detalle')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        @elseif($solicitud->getOriginal()['tipo']==="Ayudantía")
                        <div class="form-group" id="groupTelefono" >
                            <label class="form-control-label">TELEFONO CONTACTO</label>
                            <input id="telefono" type="text"
                                class="form-control @error('telefono') is-invalid @enderror" name="telefono"
                                value="{{ old('telefono') }}" autofocus placeholder="{{ $solicitud->getOriginal()['pivot_telefono'] }}">

                            @error('telefono')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group" id="groupNombre">
                            <label class="form-control-label">NOMBRE ASIGNATURA</label>
                            <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror"
                                name="nombre" value="{{ old('nombre') }}" autofocus placeholder="{{ $solicitud->getOriginal()['pivot_nombre_asignatura'] }}">

                            @error('nombre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group" id="groupDetalles">
                            <label class="form-control-label">DETALLES DE LA SOLICITUD</label>
                            <textarea id="detalle" type="text"
                                class="form-control @error('detalle') is-invalid @enderror" name="detalle"
                                value="{{ old('detalle') }}" autofocus placeholder="{{ $solicitud->getOriginal()['pivot_detalles'] }}"></textarea>

                            @error('detalle')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group" id="groupCalificacion">
                            <label class="form-control-label">CALIFICACIÓN DE APROBACIÓN</label>
                            <input id="calificacion" type="text"
                                class="form-control @error('calificacion') is-invalid @enderror" name="calificacion"
                                value="{{ old('calificacion') }}" autofocus placeholder="{{ $solicitud->getOriginal()['pivot_calificacion_aprob'] }}">

                            @error('calificacion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group" id="groupCantidad">
                            <label class="form-control-label">CANTIDAD DE AYUDANTIAS REALIZADAS</label>
                            <input id="cantidad" type="text"
                                class="form-control @error('cantidad') is-invalid @enderror" name="cantidad"
                                value="{{ old('cantidad') }}"
                                autofocus placeholder="{{ $solicitud->getOriginal()['pivot_cant_ayudantias'] }}">

                            @error('cantidad')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        @elseif($solicitud->getOriginal()['tipo']==="Facilidades")
                        <div class="form-group" id="groupTelefono" >
                            <label class="form-control-label">TELEFONO CONTACTO</label>
                            <input id="telefono" type="text"
                                class="form-control @error('telefono') is-invalid @enderror" name="telefono"
                                value="{{ old('telefono') }}" autofocus placeholder="{{ $solicitud->getOriginal()['pivot_telefono'] }}">

                            @error('telefono')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group" id="groupNombre">
                            <label class="form-control-label">NOMBRE ASIGNATURA</label>
                            <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror"
                                name="nombre" value="{{ old('nombre') }}" autofocus placeholder="{{ $solicitud->getOriginal()['pivot_nombre_asignatura'] }}">

                            @error('nombre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group" id="groupDetalles">
                            <label class="form-control-label">DETALLES DE LA SOLICITUD</label>
                            <textarea id="detalle" type="text"
                                class="form-control @error('detalle') is-invalid @enderror" name="detalle"
                                value="{{ old('detalle') }}" autofocus placeholder="{{ $solicitud->getOriginal()['pivot_detalles'] }}"></textarea>

                            @error('detalle')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group" id="groupTipoFacilidad">
                            <label for="form-control-label" style="color: white">TIPO DE FACILIDAD</label>
                            <select class="form-control" name="facilidad" id="facilidad">
                                <option value={{ null }}>Seleccione..</option>
                                <option value="Licencia">Licencia Médica o Certificado Médico</option>
                                <option value="Inasistencia Fuerza Mayor">Inasistencia por Fuerza Mayor</option>
                                <option value="Representacion">Representación de la Universidad</option>
                                <option value="Inasistencia Motivo Personal">Inasistencia a Clases por Motivos
                                    Familiares</option>
                            </select>
                        </div>

                        <div class="form-group" id="groupProfesor">
                            <label class="form-control-label">NOMBRE PROFESOR</label>
                            <input id="profesor" type="text"
                                class="form-control @error('profesor') is-invalid @enderror" name="profesor"
                                value="{{ old('profesor') }}" autofocus placeholder="{{ $solicitud->getOriginal()['pivot_nombre_profesor'] }}">

                            @error('profesor')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group" id="groupAdjunto">
                            <label class="form-control-label">ADJUNTAR ARCHIVO</label>
                            <input id="adjunto" type="file" class="form-control @error('adjunto') is-invalid @enderror"
                                name="adjunto[]" multiple >

                            @error('adjunto')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        @endif
                        <div  id="groupButton" class="col-lg-12 py-3">
                            <div class="col-lg-12 text-center">
                                <button type="submit" id="boton" class="btn btn-outline-primary">{{ __('Editar')
                                    }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-3 col-md-2"></div>
        </div>
</div>
 @endsection
