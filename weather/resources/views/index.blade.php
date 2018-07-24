@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Weather forecast</div>

                    <div class="card-body">

                        <h3>Current weather</h3>
                        <form action="{{ route('weatherToday') }}" method="post">
                            {{ csrf_field() }}
                            <input type="text" class="form-control" name="city" required placeholder="Choose city">
                            <input type="submit" value="Get weather data" class="btn btn-primary">
                        </form>


                        @if(Auth::user())
                            <h3>5 days weather</h3>

                            <form action="{{ route('weatherFiveDays') }}" method="post">
                                {{ csrf_field() }}
                                <input type="text" class="form-control" name="city" required placeholder="Choose city">
                                <input type="submit" value="Get weather data" class="btn btn-primary">
                            </form>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
