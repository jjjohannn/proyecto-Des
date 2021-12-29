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
    <div class="row justify-content-center">

        <div>
            <div class="col col-1">
                <div class="row justify-content-center">
                    <a class="btn btn-secondary" href="{{ route('resolver') }}" class="btn btn-secondary">Atras</a>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Información de la solicitud') }}</div>

                @include('alerta.flash-message')
                <div class="card-body">
                    <div class="form-group row">
                        <label for="fecha" class="col-md-4 text-md-right">{{ __('Fecha') }}</label>
                        <div>
                            <i class="text">{{ $solicitud->pivot->created_at }}</i>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="solicitud" class="col-md-4 text-md-right">{{ __('Solicitud') }}</label>
                        <div>
                            <i class="text">{{ $solicitud->pivot->id }}</i>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rut" class="col-md-4 text-md-right">{{ __('Rut') }}</label>
                        <div>
                            <i class="text">{{ $alumno->rut }}</i>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nombre" class="col-md-4 text-md-right">{{ __('Nombre') }}</label>
                        <div>
                            <i class="text">{{ $alumno->name }}</i>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tipo" class="col-md-4 text-md-right">{{ __('Tipo') }}</label>
                        <div>
                            <i class="text">{{ $solicitud->tipo }}</i>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="correo" class="col-md-4 text-md-right">{{ __('Correo') }}</label>
                        <div>
                            <i class="text">{{ $alumno->email }}</i>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="telefono" class="col-md-4 text-md-right">{{ __('Teléfono') }}</label>
                        <div>
                            <i class="text">{{ __('+56 9') }}</i>
                            <i class="text">{{ $solicitud->pivot->telefono }}</i>
                        </div>
                    </div>


                    <div class="form-group row justify-content-center">
                        <label for="archivos" >{{ __('Archivos') }}</label>
                        <div class="col-md-5 text-md-left">
                            @if ($solicitud->getOriginal()['pivot_archivos'])
                                @foreach (json_decode($solicitud->getOriginal()['pivot_archivos']) as $file)
                                    <div><a href={{"/storage/docs/".$file}}>{{$file}}</a></div>
                                @endforeach
                            @endif
                        </div>
                    </div>


                    <div class="row">
                        <label for="detalle" class="col-md-4 text-md-right">{{ __('Detalle') }}</label>
                        <div>
                            <textarea disabled id="detalle" type="text" class="form-control" name="detalle">{{ $solicitud->pivot->detalles }}</textarea>
                        </div>
                    </div>


                    <form id="formulario" method="POST" action="{{ route('resolverSolicitud.update', [$solicitud]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="form-control-label" style="color: black">Resolución</label>
                            <select class="form-control" name="tipo" id="tipo">
                                <option value={{ null }}>Seleccione..</option>
                                <option value="1" @if(old('tipo') == "1") selected @endif>Aceptar</option>
                                <option value="2" @if(old('tipo') == "2") selected @endif>Aceptar con observación</option>
                                <option value="3" @if(old('tipo') == "3") selected @endif>Rechazar</option>
                            </select>
                        </div>

                        <div class="form-group" id="groupAceptar" hidden>
                            <input id="solicitud" type="text" class="form-control" name="solicitud" value="{{ $solicitud->pivot->id }}" hidden>
                            <input id="alumno" type="text" class="form-control" name="alumno" value="{{ $alumno->id }}" hidden>
                        </div>

                        <div hidden id="groupButtonAceptar" class="col-lg-12 py-3">
                            <div class="col-lg-12 text-center">
                                <button id="aceptar" name="action" type="submit" value="aceptar" class="btn btn-outline-primary">{{ __('Aceptar')}}</button>
                            </div>
                        </div>

                        <div class="form-group" id="groupObservacion" hidden>
                            <label class="form-control-label">DETALLES DE LA SOLICITUD</label>
                            <input id="solicitud" type="text" class="form-control" name="solicitud" value="{{ $solicitud->pivot->id }}" hidden>
                            <input id="alumno" type="text" class="form-control" name="alumno" value="{{ $alumno->id }}" hidden>

                            <textarea id="detalles" type="text"
                            class="form-control @error('detalles') is-invalid @enderror" name="detalles"
                            value="{{ old('detalles') }}" autocomplete="detalles" autofocus></textarea>

                            @error('detalles')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div hidden id="groupButtonObservacion" class="col-lg-12 py-3">
                            <div class="col-lg-12 text-center">
                                <button name="action" type="submit" value="observacion" class="btn btn-outline-primary">{{ __('Aceptar con observación')}}</button>
                            </div>
                        </div>

                        <div class="form-group" id="groupRechazar" hidden>
                            <label class="form-control-label">DETALLES DE LA SOLICITUD</label>
                            <input id="solicitud" type="text" class="form-control" name="solicitud" value="{{ $solicitud->pivot->id }}" hidden>
                            <input id="alumno" type="text" class="form-control" name="alumno" value="{{ $alumno->id }}" hidden>

                            <textarea id="detalles2" type="text"
                            class="form-control @error('detalles2') is-invalid @enderror" name="detalles2"
                            value="{{ old('detalles2') }}" autocomplete="detalles2" autofocus></textarea>

                            @error('detalles2')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div hidden id="groupButtonRechazar" class="col-lg-12 py-3">
                            <div class="col-lg-12 text-center">
                                <button id="rechazar" name="action" type="submit" value="rechazar" class="btn btn-outline-primary">{{ __('Rechazar')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    const selectSolicitud = document.getElementById('tipo');
    const inputAceptar = document.getElementById('groupAceptar');
    const inputObservacion = document.getElementById('groupObservacion');
    const inputRechazar = document.getElementById('groupRechazar');
    const buttonAceptar = document.getElementById('groupButtonAceptar');
    const buttonObservacion = document.getElementById('groupButtonObservacion');
    const buttonRechazar = document.getElementById('groupButtonRechazar');

    const variable = {!! json_encode(old('tipo')) !!}
    switch (variable) {
            case "1":
                inputAceptar.hidden = false;
                inputObservacion.hidden = true;
                inputRechazar.hidden = true;
                buttonAceptar.hidden = false;
                buttonObservacion.hidden = true;
                buttonRechazar.hidden = true;
                break;
            case "2":
                inputAceptar.hidden = true;
                inputObservacion.hidden = false;
                inputRechazar.hidden = true;
                buttonAceptar.hidden = true;
                buttonObservacion.hidden = false;
                buttonRechazar.hidden = true;
                break;
            case "3":
                inputAceptar.hidden = true;
                inputObservacion.hidden = true;
                inputRechazar.hidden = false;
                buttonAceptar.hidden = true;
                buttonObservacion.hidden = true;
                buttonRechazar.hidden = false;
                break;
            default:
            inputAceptar.hidden = true;
                inputObservacion.hidden = true;
                inputRechazar.hidden = true;
                buttonAceptar.hidden = true;
                buttonObservacion.hidden = true;
                buttonRechazar.hidden = true;
                break;
    }
    selectSolicitud.addEventListener('change', () => {
        switch (selectSolicitud.value) {
            case "1":
                inputAceptar.hidden = false;
                inputObservacion.hidden = true;
                inputRechazar.hidden = true;
                buttonAceptar.hidden = false;
                buttonObservacion.hidden = true;
                buttonRechazar.hidden = true;
                break;
            case "2":
                inputAceptar.hidden = true;
                inputObservacion.hidden = false;
                inputRechazar.hidden = true;
                buttonAceptar.hidden = true;
                buttonObservacion.hidden = false;
                buttonRechazar.hidden = true;
                break;
            case "3":
                inputAceptar.hidden = true;
                inputObservacion.hidden = true;
                inputRechazar.hidden = false;
                buttonAceptar.hidden = true;
                buttonObservacion.hidden = true;
                buttonRechazar.hidden = false;
                break;
            default:
                inputAceptar.hidden = true;
                inputObservacion.hidden = true;
                inputRechazar.hidden = true;
                buttonAceptar.hidden = true;
                buttonObservacion.hidden = true;
                buttonRechazar.hidden = true;
                break;
        }
    })
</script>

<script>
    const boton = document.getElementById('groupButtonAceptar');
    const formulario = document.getElementById('formulario');
    boton.addEventListener('click', function(e){
        e.preventDefault();
    Swal.fire({
        title: '¿Quiéres generar esta solicitud?',
        icon: 'question',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Si',
        denyButtonText: 'No',
    }).then((result)=>{
        if(result.isConfirmed){
            $("<input />").attr("type", "hidden")
          .attr("name", "action")
          .attr("value", "aceptar")
          .appendTo(formulario);
            formulario.submit();
        }else if(result.isDenied){
            Swal.fire('No se ha generado la solicitud', '', 'info')
        }
    })
})
</script>
<script>
    const boton = document.getElementById('groupButtonObservacion');
    const formulario = document.getElementById('formulario');
    boton.addEventListener('click', function(e){
        e.preventDefault();
    Swal.fire({
        title: '¿Quiéres generar esta solicitud?',
        icon: 'question',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Si',
        denyButtonText: 'No',
    }).then((result)=>{
        if(result.isConfirmed){
            $("<input />").attr("type", "hidden")
          .attr("name", "action")
          .attr("value", "observacion")
          .appendTo(formulario);
            formulario.submit();
        }else if(result.isDenied){
            Swal.fire('No se ha generado la solicitud', '', 'info')
        }
    })
})
</script>
<script>
    const boton = document.getElementById('groupButtonRechazar');
    const formulario = document.getElementById('formulario');
    boton.addEventListener('click', function(e){
        e.preventDefault();
    Swal.fire({
        title: '¿Quiéres generar esta solicitud?',
        icon: 'question',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Si',
        denyButtonText: 'No',
    }).then((result)=>{
        if(result.isConfirmed){
            $("<input />").attr("type", "hidden")
          .attr("name", "action")
          .attr("value", "rechazar")
          .appendTo(formulario);
            formulario.submit();
        }else if(result.isDenied){
            Swal.fire('No se ha generado la solicitud', '', 'info')
        }
    })
})
</script>
@endsection
