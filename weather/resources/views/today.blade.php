@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Weather</div>

                    <div class="card-body">
                        <h1>{{ $city }}</h1>
                        Temperature: {{ $weather->main->temp }}&deg;C<br>
                        Humidity: {{ $weather->main->humidity }}%
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
