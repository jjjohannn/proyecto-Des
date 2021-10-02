@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
<<<<<<< HEAD
=======
                    <a class="text" href="{{ route('index') }}">{{ __('Acceder') }}</a>
>>>>>>> e95563c711dc270faf150be3592dab67142219f9
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
