@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach($todos as $todo)
                        <div class="card mb-3">
                            @if($todo->status)
                                <s>{{$todo->description}}</s>
                            @else
                                {{$todo->description}}
                            @endif
                            <a href="{{ route('userTodos', $todo->user->id) }}">{{$todo->user->name}}</a>
                            <div class="btn-group">
                                <form action="{{route('changeTodoStatus', $todo->id)}}" method="post">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="PUT">
                                    <button type="submit" class="btn btn-info">Change status</button>
                                </form>
                                <form action="{{route('deleteTodo', $todo->id)}}" method="post">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-warning">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach

                    @if(Auth::check())
                    <form action="{{route('addTodo')}}" method="post">
                        {{csrf_field()}}
                        <textarea name="description" class="form-control"></textarea>
                        <button class="btn btn-default" type="submit">Add</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
