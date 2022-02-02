@extends('layouts.app')
<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.3.0/mapbox-gl.css' rel='stylesheet' />
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

                    {{ __('Вы залогинены!') }}
                    <div>
                        <a href="{{ url('/') }}">Домашняя страница</a>
                    </div>
                    <div>
                        <a href="{{ url('map') }}">Карта</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
