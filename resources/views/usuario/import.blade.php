@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">

            <div>
                <div class="card">
                    <div class="card-header">{{ __('Menu') }}</div>

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

                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="/users/import" method="post" enctype="multipart/form-data" >
                            @csrf

                            <div class="form-group">
                                <input type="file" name="file" />

                                <button type="submit" class="btn btn-primary">Importar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
    </div>


@endsection
