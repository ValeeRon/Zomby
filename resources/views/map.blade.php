@extends('layouts.app')
<link
    href="https://api.tiles.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.css"
    rel="stylesheet"
/>
@section('content')
    <div class="container container-map">
        <map-component></map-component>
    </div>
@endsection
