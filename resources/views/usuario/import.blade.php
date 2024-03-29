@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">

            <div>
                <div class="card">
                    <div class="card-header">{{ __('Menú') }}</div>

                    <div class="card-body">
                        <a class="text" href="{{ route('usuario.index') }}">{{ __('Inicio') }}</a>
                    </div>

                    <div class="card-body">
                        <a class="text"  href="{{ route('custom-registration') }}">{{ __('Registrar') }}</a>
                    </div>

                    <div class="card-body">
                        <a class="text" href="{{ route('gestionCarrera') }}">{{ __('Gestionar Carreras') }}</a>
                    </div>

                    <div class="card-body">
                        <a class="text" href=" {{ route('usuario.editList') }} ">{{ __('Editar') }}</a>
                    </div>
                    
                    <div class="card-body">
                        <a class="text" href=" {{ route('cargaMasiva') }} ">{{ __('Carga Masiva') }}</a>
                    </div>

                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Importar') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="/users/import" method="post" enctype="multipart/form-data" >
                            @csrf

                            <div class="form-group">
                                <input type="file" name="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />

                                <button type="submit" class="btn btn-primary">Importar</button>
                            </div>
                        </form>
 
                        @if (isset($errors) && $errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{$error}}
                                @endforeach
                        @endif

                        @if (session()->has('failures'))

                            <table class="table table-danger">
                                <tr>
                                    <th>Fila</th>
                                    <th>Campo</th>
                                    <th>Tipo de error</th>
                                    <th>Valor</th>
                                </tr>
                                @foreach (session()->get('failures') as $validation)
                                    <tr>
                                        <td>{{$validation->row()}}</td>
                                        <td>{{$validation->attribute()}}</td>
                                        <td>
                                            <ul>
                                                @foreach($validation->errors() as $e)
                                                    <li>{{ $e }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            {{$validation->values()[$validation->attribute()]}}
                                        </td>
                                
                                @endforeach

                            </table>
                        @endif

                        @if (session()->has('importedUsers'))
                            <table class="table table-bordered">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Rut</th>
                                    <th>Correo</th>
                                </tr>
                                @foreach (session()->get('importedUsers') as $userImported)
                                <tr>
                                    <td>{{$userImported['nombre']}}</td>
                                    <td>{{$userImported['rut']}}</td>
                                    <td>{{$userImported['correo']}}</td>
                                @endforeach
                            </table>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
    </div>


@endsection
