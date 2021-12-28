@extends('layouts.app')

@section('content')

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="container">
    <div class="row mb-4">
        <!--<div class="col col-3">
            <form class="form-inline my-2 my-lg-0" method="GET" action="">
                <input class="form-control mr-sm-2" name="search" id="search" type="search"
                    placeholder="Buscar por código" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i>Ir</button>
            </form>
        </div>-->
        <div class="col col-7">
            <p class="text-center" style="font-size: x-large">Mis Solicitudes</p>
        </div>
        <div class="col col-2">
            <a class="btn btn-success btn-block" href="solicitud/create"> <i class="fas fa-plus"></i> Nueva Solicitud</a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col col-1">
            <div class="row justify-content-center">
                <a class="btn btn-secondary" href="{{ route('usuario.index') }}" class="btn btn-secondary">Atrás</a>
            </div>
        </div>

        <div class="col col-10">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="width: 15%" scope="col">Fecha Solicitud</th>
                        <th style="width: 20%" scope="col">Número Solicitud</th>
                        <th style="width: 30%" scope="col">Tipo Solicitud</th>
                        <th style="width: 20%" scope="col">Estado</th>
                        <th style="width: 10%" scope="col">Editar</th>
                        <th style="width: 10%" scope="col">Anular</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($solicitudes as $solicitud)
                    <tr>
                        <th scope="row">{{ $solicitud->getOriginal()['pivot_updated_at'] }}</th>
                        <td>{{ $solicitud->getOriginal()['pivot_id'] }}</td>
                        <td>{{$solicitud->tipo}}</td>
                        @switch($solicitud->getOriginal()['pivot_estado'])
                        @case(0)
                        <td>
                            <div class="alert alert-warning" role="alert">
                                Pendiente
                            </div>
                        </td>
                        @break
                        @case(1)
                        <td>
                            <div class="alert alert-success" role="alert">
                                Aceptada
                            </div>
                        </td>
                        @break
                        @case(2)
                        <td>
                            <div class="alert alert-success" role="alert">
                                Aceptada con observaciones
                            </div>
                        </td>
                        @break
                        @case(3)
                        <td>
                            <div class="alert alert-danger" role="alert">
                                Rechazada
                            </div>
                        </td>
                        @break
                        @case(4)
                        <td>
                            <div class="alert alert-danger" role="alert">
                                Anulada
                            </div>
                        </td>
                        @break
                        @default

                        @endswitch
                        @if ($solicitud->getOriginal()['pivot_estado'] === 0)
                            <td><a class="btn btn-info" data-toggle="tooltip" data-placement="top" title="editar" href={{route('solicitud.edit', [$solicitud->pivot->id]) }}><i class="far fa-edit"></i>Ir</a></td>
                            <!--<td><a class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="anular" href={{ route('solicitud.anular', ['id' => $solicitud->pivot->id]) }}>Anular</a></td>-->
                            <!--<td><button id="myInput" class="btn btn-warning" type="button" data-toggle="tooltip" data-placement="top" href={{ route('solicitud.anular', ['id' => $solicitud->pivot->id]) }} title="anular">Anular3</button></td>-->
                            <td><input class="myInput" id="myInput" data-id="{{$solicitud->pivot->id}}" type="button" value="{{$solicitud->pivot->id}}" href="{{ route('solicitud.anular', ['id' => $solicitud->pivot->id]) }}" >An3</td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <p>No hay solicitudes ingresadas</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    const boton = document.getElementById('myInput');

    /*$('.myInput').on('click', 'button[data-id]', function (e) {
    var requested_to = $(this).attr('data-id');
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
            var id = $(this).val();
            var base = '{!! route('solicitud.anular') !!}';
            var url = base+'?id='+id ;
            window.location.href=url;
        }else if(result.isDenied){
            Swal.fire('No se ha generado la solicitud', '', 'info')
        }
    })
    // Do whatever else you need to do.
    });*/

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
            /*function addRow(ele)
            {
                var id= $(ele).attr('data-id');
                //console.log(id);
            }*/
            //var id=$e.attr('id');
            /*console.log(this.val());
            $('.myInput').click(function() {
                //console.log(this.val())
                var url = "{{route('solicitud.anular', '')}}"+"/"+this.val();
            });*/
            /*var url = '{{ route('solicitud.anular', ":id") }}';
            url = url.replace(':id', this.val());
            //$('.stocks_list').append('<li><a href="'+url+'">' + stock.symbol + ' </a></li>');
            $('.myInput').append('<li><a href="'+url+'">' + this.val() + ' </a></li>');*/
            /*Swal.fire({
                title: '<a href={{ route('solicitud.anular', ['id' => $solicitud->pivot->id]) }}>a</a>',
            });*/

            /*var url = '{{ route("solicitud.anular", ":id") }}';

            url = url.replace(':id', id);



            window.location.href=url;*/

            /*$('.myInput').click(function() {
                var id = $(this).val();
                //var id = $(this).attr('data-id');

                var base = '{!! route('solicitud.anular') !!}';

                var url = base+'?id='+id ;

                window.location.href=url;
            });*/

            var id = $(this).val();
            //var id = $(this).attr('data-id');

            var base = '{!! route('solicitud.anular') !!}';

            var url = base+'?id='+id ;

            window.location.href=url;



        }else if(result.isDenied){
            Swal.fire('No se ha generado la solicitud', '', 'info')
        }
    })
})
</script>
@endsection
