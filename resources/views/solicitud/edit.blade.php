@extends('layouts.app')

@section('content')

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@elseif (session('error'))
<div class="alert alert-warning">
    {{ session('error') }}
</div>
@endif

<div class="container">
        <div class="col col-10">
            <div class="col-lg-12 login-form">
                <div class="col-lg-12 login-form">
                    <form method="POST" id="formulario" enctype="multipart/form-data" action="{{ route('solicitud.update',[$solicitud->pivot->id]) }}">
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
                            <label for="form-control-label" style="color: black">TIPO DE FACILIDAD</label>
                            <select class="form-control" name="facilidad" id="facilidad" placeholder="{{ $solicitud->getOriginal()['pivot_tipo_facilidad'] }}">
                                @if($solicitud->getOriginal()['pivot_tipo_facilidad'] === "Licencia")
                                <option value={{ old('tipo_facilidad')}}>Licencia Médica o Certificado Médico</option>
                                @elseif($solicitud->getOriginal()['pivot_tipo_facilidad'] === "Inasistencia Fuerza Mayor")
                                <option value={{ old('tipo_facilidad')}}>Inasistencia por Fuerza Mayor</option>
                                @elseif($solicitud->getOriginal()['pivot_tipo_facilidad'] === "Representacion")
                                <option value={{ old('tipo_facilidad')}}>Representación de la Universidad</option>
                                @elseif($solicitud->getOriginal()['pivot_tipo_facilidad'] === "Inasistencia Motivo Personal")
                                <option value={{ old('tipo_facilidad')}}>Inasistencia a Clases por Motivos Familiares</option>
                                @endif
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




                        <table class="table" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 15%" scope="col">Archivos</th>
                                    <th style="width: 15%" scope="col">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @if ($solicitud->getOriginal()['pivot_archivos'])
                                        @foreach (json_decode($solicitud->getOriginal()['pivot_archivos']) as $file)
                                                <tr>
                                                    <td><a href="/storage/docs/{{$file}}">{{$file}}</a> </td>
                                                    <td><a id="eliminar" class="btn btn-secondary" href={{ route('solicitud.eliminar',['nombre'=>$file,'id'=>$solicitud->pivot->id])}} >Eliminar</a></td>
                                                </tr>
                                        @endforeach
                                    @endif
                                </tr>
                            </tbody>
                        </table>


                        <div class="form-group" id="groupAdjunto">
                            <label class="form-control-label">ADJUNTAR ARCHIVO</label>
                            <input id="adjunto" type="file" class="form-control @error('adjunto') is-invalid @enderror"
                                name="adjunto[]" multiple>

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
                        <div class="col-lg-12 py-3">
                            <div class="col-lg-12 text-center">
                            <a class="btn btn-secondary" href="{{ route('solicitud.index') }}" class="btn btn-secondary">Atras</a>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-3 col-md-2"></div>
        </div>
</div>


<script>
    const boton = document.getElementById('groupButton');
    const formulario = document.getElementById('formulario');
    boton.addEventListener('click', function(e){
        e.preventDefault();
    Swal.fire({
        title: '¿Quiéres editar esta solicitud?',
        icon: 'question',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Si',
        denyButtonText: 'No',
    }).then((result)=>{
        if(result.isConfirmed){
            formulario.submit();
        }else if(result.isDenied){
            Swal.fire('No se ha editado la solicitud', '', 'info')
        }
    })
})
</script>
 @endsection
