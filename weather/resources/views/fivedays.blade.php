@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">5 days weather forecast</div>

                    <div class="card-body">
                        <h1>{{ $city }}</h1>

                        <table class="table table-striped">
                            <tr>
                                <th>Date</th>
                                <th>Temperature &deg;C</th>
                                <th>Humidity, %</th>
                                <th>Weather</th>
                            </tr>
                            @foreach($forecast->list as $item)
                                <tr>
                                    <td>{{ date('d.m.Y H:i', $item->dt) }}</td>
                                    <td>{{ $item->main->temp }}</td>
                                    <td>{{ $item->main->humidity }}</td>
                                    <td>{{ $item->weather[0]->main }}, {{ $item->weather[0]->description }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
