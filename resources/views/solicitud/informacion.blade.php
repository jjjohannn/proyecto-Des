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
                            <i class="text">{{ __('+569') }}</i>
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

                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Aceptar</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Aceptar con observación</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Rechazar</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <table class="table" cellspacing="0">
                                <thead>
                                    <tr>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <tr>
                                            <td>
                                                <form method="POST" id="formAceptar" action="{{ route('resolverSolicitud.update', [$solicitud]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input id="value" type="text" class="form-control" name="value" value="1" hidden>
                                                    <input id="solicitud" type="text" class="form-control" name="solicitud" value="{{ $solicitud->pivot->id }}" hidden>
                                                    <input id="alumno" type="text" class="form-control" name="alumno" value="{{ $alumno->id }}" hidden>

                                                    <hr noshade="noshade" size="2" width="100%">
                                                    <button type="submit" id = "botonAceptar" class="btn btn-success me-2" style= "margin: 40px 50px 0 40%">
                                                        {{ __('Aceptar') }}
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <table class="table" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="width: 15%" scope="col">Comentario</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <tr>
                                            <td>
                                                <form method="POST" id="formAceptarObs" action="{{ route('resolverSolicitud.update', [$solicitud]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input id="value2" type="text" class="form-control" name="value2" value="2" hidden>
                                                    <input id="solicitud" type="text" class="form-control" name="solicitud" value="{{ $solicitud->pivot->id }}" hidden>
                                                    <input id="alumno" type="text" class="form-control" name="alumno" value="{{ $alumno->id }}" hidden>

                                                    <textarea id="detalles" type="text"
                                                    class="form-control" name="detalles"
                                                    value="{{ old('detalles') }}" autocomplete="detalles" autofocus></textarea>

                                                    <button type="submit" id="botonAceptarObs" class="btn btn-primary me-2" style= "margin: 40px 50px 0 40%">
                                                        {{ __('Aceptar con obs') }}
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <table class="table" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="width: 15%" scope="col">Comentario</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <tr>
                                            <td>
                                                <form id="formRechazar" method="POST"  action="{{ route('resolverSolicitud.update', [$solicitud]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input id="value3" type="text" class="form-control" name="value3" value="3" hidden>
                                                    <input id="solicitud" type="text" class="form-control" name="solicitud" value="{{ $solicitud->pivot->id }}" hidden>
                                                    <input id="alumno" type="text" class="form-control" name="alumno" value="{{ $alumno->id }}" hidden>

                                                    <textarea id="detalles" type="text"
                                                    class="form-control" name="detalles"
                                                    value="detalles" autocomplete="detalles" autofocus></textarea>

                                                    <button type="submit" id="botonRechazar" class="btn btn-primary me-2" style= "margin: 40px 50px 0 40%">
                                                        {{ __('Rechazar') }}
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const botonAceptar = document.getElementById('botonAceptar');
    const botonAcepObs = document.getElementById('botonAceptarObs');
    const botonRechazar = document.getElementById('botonRechazar');
    const formularioAceptar = document.getElementById('formAceptar');
    const formularioAcepObs = document.getElementById('formAceptarObs');
    const formularioRechazar = document.getElementById('formRechazar');
    botonAceptar.addEventListener('click', function(e){
        e.preventDefault();
    Swal.fire({
        title: '¿Quiéres aceptar esta solicitud?',
        icon: 'question',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Si',
        denyButtonText: 'No',
    }).then((result)=>{
        if(result.isConfirmed){
            formularioAceptar.submit();
            Swal.fire('Se ha aceptado la solicitud!', '', 'success')
        }else if(result.isDenied){
            Swal.fire('No se ha aceptado la solicitud', '', 'info')
        }
    })
})
    botonAcepObs.addEventListener('click', function(e){
        e.preventDefault();
    Swal.fire({
        title: '¿Quiéres aceptar esta solicitud?',
        icon: 'question',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Si',
        denyButtonText: 'No',
    }).then((result)=>{
        if(result.isConfirmed){
            formularioAcepObs.submit();

        }else if(result.isDenied){
            Swal.fire('No se ha aceptado la solicitud', '', 'info')
        }
    })
})
    botonRechazar.addEventListener('click', function(e){
        e.preventDefault();
    Swal.fire({
        title: '¿Quiéres rechazar esta solicitud?',
        icon: 'question',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Si',
        denyButtonText: 'No',
    }).then((result)=>{
        if(result.isConfirmed){
            formularioRechazar.submit();

        }else if(result.isDenied){
            Swal.fire('No se ha aceptado la solicitud', '', 'info')
        }
    })
})
</script>

@endsection
